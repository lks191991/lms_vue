<?php
   
namespace App\Http\Controllers\API\V1\Front;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\V1\Front\BaseController as BaseController;
use App\Models\Page;
use App\Models\Setting;
use App\Models\SubCategory;
use App\Models\Slider;
use App\Models\Course;
use App\Models\Rating;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\Auth;
use App\Models\ContactInquiry;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Mail\sendContactInquiry;

class PageController extends BaseController
{
    
    /**
     * Companylist api
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id)
    {
        $pageId = $id;
		if($pageId=='')
		{
			$errorMsg = "Page not found";       
           return $this->sendError($errorMsg); 
		}
		else
		{
			$page = Page::where(['id' => $pageId])->first(); 
			return $this->sendResponse($page, 'Page');
		}
       

    }
	
	public function setting()
    {
        
			$settings = Setting::get(); 
			$settingsData = [];
			foreach($settings as $s)
			{
				$settingsData[$s->key_name] = $s->val;
			}
			return $this->sendResponse($settingsData, 'Page');
       

    }
	
	public function courseMenu()
    {
        
			//$courseMenu = SubCategory::select('id','name')->with("courses")->get(); 
			$courseMenu = SubCategory::with(['courses' => function ($query) {
			$query->select('courses.id', 'courses.name', 'courses.sub_category_id');
			}])
			->select('id', 'name')
			->get();
			return $this->sendResponse($courseMenu, 'course Menu');
       

    }

	public function homePageCategory()
    {
        
		$homePageCategory = SubCategory::select('id', 'name')->withCount('courses')->get();
			return $this->sendResponse($homePageCategory, 'Home Page Category');

    }

	public function courseViewUpdate(Request $request)
    {
        	$input = $request->all();
			$homePageCategory = Course::where("id",$input["course_id"])->first();
			$total_view = $homePageCategory->total_view+1;
			$homePageCategory->total_view = $total_view;
			$homePageCategory->save();
			return $this->sendResponse($homePageCategory->total_view, 'course View');
       

    }

	
	
	public function homeSlider()
    {
        
			$sliders = Slider::select('id','name','slider_image','description')->get(); 
			
			return $this->sendResponse($sliders, 'Slider');
    }
	
	public function homePageCourse()
    {
        
			$courses = Course::take(3)->with("tutor")->withCount('total_lesson')->withAvg('courseRating', 'rating')->get();
			return $this->sendResponse($courses, 'courses Home');

    }
	
	public function allCourses(Request $request)
    {
			$data = $request->all();
			if(!empty($data['search']))
			{
				$courses = Course::where("name", 'like', '%'.$data['search'].'%')->with("tutor")->withCount('total_lesson')->withAvg('courseRating', 'rating')->paginate(9);
			}
			elseif(!empty($data['sub_category_id']))
			{
				$courses = Course::where("sub_category_id",  $data['sub_category_id'])->with("tutor")->withCount('total_lesson')->withAvg('courseRating', 'rating')->paginate(9);
			}
			else
			{
				$courses = Course::withCount('total_lesson')->withAvg('courseRating', 'rating')->with("tutor")->paginate(9);
			}
			
			return $this->sendResponse($courses, 'courses all');

    }

	
	public function courseByCategory(Request $request)
    {
        
			$data = $request->all();
		if($data['sub_category_id']=='')
		{
			$errorMsg = "Page not found";       
           return $this->sendError($errorMsg); 
		}
		else
		{
			$page = Course::where(['id' => $data['sub_category_id']])->with("tutor")->withCount('total_lesson')->withAvg('courseRating', 'rating')->get(); 
			return $this->sendResponse($page, 'Course by sub category');
		}

    }
	public function courseDetails(Request $request)
    {
        $data = $request->all();
		if($data['course_id']=='')
		{
			$errorMsg = "Page not found";       
           return $this->sendError($errorMsg); 
		}
		else
		{	
			
			$course = Course::where(['id' => $data['course_id']])->with("tutor")->withCount(['total_lesson','courseRating'])->withAvg('courseRating', 'rating')->with(['tutor','topics','topics.videosTitles'])->first(); 
			$returnData['course'] = $course;
			
			$review = Rating::where(['course_video_id' => $data['course_id']])->with(['user'])->paginate(2);
			$returnData['review'] = $review;
			$userSubscription = UserSubscription::where("course_id",$data['course_id'])->where("status",'Success')->count();
			$returnData['enrolled'] = $userSubscription;
			return $this->sendResponse($returnData, 'Course Details');
		}
       

    }

	 /**
     * Send  Contact email and save data in table .
     *
     */
    public function sendContact(Request $request)
    {	

        $validator = Validator::make($request->all(), [
			'your_name' => 'required',
			'mobile_number' => 'required|numeric',
			'email' => 'required|email|max:255',
			'message' => 'required',
		]);

        if ($validator->fails()) {
           return $this->sendError('Validation Error.', $validator->errors()); 
        }

         $contactInquiry =  new ContactInquiry;
         $contactInquiry->your_name     = $request->input('your_name');
         $contactInquiry->mobile_number = $request->input('mobile_number');
         $contactInquiry->email         = $request->input('email');
         $contactInquiry->message       = $request->input('message');
         $contactInquiry->sending_as    = $request->input('sending_as');
         $contactInquiry->save();

       
        
        $data = (object) array(
                'your_name'      => $request->input('your_name'),
                'mobile_number'  => $request->input('mobile_number'),
                'email'          => $request->input('email'),
                'message'        => $request->input('message'),
            );
        $setting = Setting::where('key_name','admin_email')->first(); 
        $sendTo = $setting->admin_email;
        //$sendTo = 'xtraclass@mailinator.com';
	
		Mail::to($sendTo, "New contact inquiry")->send(new sendContactInquiry($data));    
		
		return $this->sendResponse($contactInquiry, 'Your enquiry has been sent successfully.');


    }
    
    public function saveNewsletter(Request $request)
    {	

        $validator = Validator::make($request->all(), [
			'email' => 'required|email|max:255',
		]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors()); 
        }

        $data = Newsletter::where("email",$request->input('email'))->first();
        if(isset($data))
        {
            return $this->sendResponse($data, "Your email has been successfully saved.");
        }
         else
         {
            $contactInquiry =  new Newsletter;
            $contactInquiry->email   = $request->input('email');
            $contactInquiry->save();
			return $this->sendResponse($contactInquiry, "Your email has been successfully saved.");
         }

    }

	public function homePageReview()
    {
        
			$ratings = Rating::with(["course","user"])->where('type','course')->take(5)->get();
			return $this->sendResponse($ratings, 'ratings Home');

    }

}
<?php
   
namespace App\Http\Controllers\API\V1\Front;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\V1\Front\BaseController as BaseController;
use App\Models\Page;
use App\Models\Setting;
use App\Models\SubCategory;
use App\Models\Slider;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;


   
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
	
	public function homeSlider()
    {
        
			$sliders = Slider::select('id','name','slider_image','description')->get(); 
			
			return $this->sendResponse($sliders, 'Slider');
    }
	
	public function homePageCourse()
    {
        
			$courses = Course::take(3)->get();
			return $this->sendResponse($courses, 'courses Home');

    }
	
	public function allCourses()
    {
        
			$courses = Course::get();
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
			$page = Course::where(['id' => $data['sub_category_id']])->get(); 
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
			$page = Course::where(['id' => $data['course_id']])->first(); 
			return $this->sendResponse($page, 'Course Details');
		}
       

    }
    

}
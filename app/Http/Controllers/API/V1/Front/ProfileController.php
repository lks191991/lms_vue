<?php
   
namespace App\Http\Controllers\API\V1\Front;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\V1\Front\BaseController as BaseController;
use App\Models\User;
use App\Models\UserSubscription;
use App\Models\Course;
use App\Models\Video;
use App\Models\StudentFlag;
use App\Models\StudentFavourites;
use App\Models\VideoWatchReport;
use App\Models\Rating;
use App\Models\QnsAns;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Image;
use Carbon\Carbon;

class ProfileController extends BaseController
{
    
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    
    public function profile()
    {
       $data = auth('api')->user();
	   $user = User::find($data->id);
       return $this->sendResponse($user, 'Profile retrieved successfully.');
    }
	
	public function editProfile(Request $request)
    {
        $options['allow_img_size'] = 10;
        $validator = Validator::make($request->all(), [
            'name' => 'required|sanitizeScripts|max:255',
            'contact' => 'required|sanitizeScripts|max:20',
            
        ],
        [
           
        ]);
   
        if($validator->fails()){
           //return $this->sendError('Validation Error.', $validator->errors()); 
           $errors = $validator->errors();
           $errorMsg = '';
           if($errors->first('name'))
                $errorMsg = $errors->first('name');
           elseif($errors->first('contact'))
               $errorMsg = $errors->first('contact'); 
         
           return $this->sendError($errorMsg); 
           
        }

        $input = $request->all();
        
        $userid = Auth::guard('api')->user()->id;
        $user = User::find($userid);
        $user->name = $input['name'];
        $user->contact = $input['contact'];
        $user->save();
        $success['name'] =  $user->name;
		$success['contact'] =  $user->contact;
        $success['image'] =  url('/uploads/users/'.$user->image);
        $success['email'] =  $user->email;
        
   
        return $this->sendResponse($success, 'Profile update successfully.');
    }
	
	 public function editProfileImage(Request $request)
    {
        $options['allow_img_size'] = 10;
        $validator = Validator::make($request->all(), [
             'image' => 'nullable|mimes:jpeg,jpg,png|max:' . ($options['allow_img_size'] * 1024),
            
        ],
        [
           
        ]);
   
        if($validator->fails()){
           $errors = $validator->errors();
           $errorMsg = '';
           if($errors->first('image'))
               $errorMsg = $errors->first('image');   
         
           return $this->sendError($errorMsg); 
           
        }

        $input = $request->all();
        /** Below code for save image **/
		$destinationPath = public_path('/uploads/users/');
		$newName = '';
		if ($request->hasFile('image')) {
           
			$fileName = $input['image']->getClientOriginalName();
			$file = request()->file('image');
			$fileNameArr = explode('.', $fileName);
			$fileNameExt = end($fileNameArr);
			$newName = date('His').rand() . time() . '.' . $fileNameExt;
			
			$file->move($destinationPath, $newName);
			
			//$user_config = json_decode($options['user'],true);
			
			$img = Image::make(public_path('/uploads/users/'.$newName));
						
            $img->resize(100, 100, function($constraint) {
				$constraint->aspectRatio();
			});
			

			$img->save(public_path('/uploads/users/thumb/'.$newName));
		}

        $input['image'] = $newName;
       
        //pr($input); die;
		$userid = Auth::guard('api')->user()->id;
        $user = User::find($userid);
		$user->image = $input['image'];
		$user->save();
        $success['image'] =  url('/uploads/users/'.$user->image);
        
   
        return $this->sendResponse($success, 'Profile image update successfully.');
    }
	
    /**
     * change password api
     *
     * @return \Illuminate\Http\Response
     */
    public function changepassword(Request $request)
    {
        //die('xvcx');

        $input = $request->all();
        $userid = Auth::guard('api')->user()->id;
        $validator = Validator::make($input, [
            'oldPassword' => 'required',
            'password' => 'required|min:8',
            'confirmPassword' => 'required|same:password',
        ],
        [
            'password.regex' => "Password contains At least one uppercase, At least one digit and At least it should have 8 characters long"
        ]);
        //$validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            //$arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
            $errors = $validator->errors();
            $errorMsg = '';
            if($errors->first('oldPassword'))
                $errorMsg = $errors->first('oldPassword'); 
            elseif($errors->first('password'))
                $errorMsg = $errors->first('password');  
            elseif($errors->first('confirmPassword'))
                $errorMsg = $errors->first('confirmPassword');           
 
            return $this->sendError($errorMsg);   
        } else {
            try {
                if ((Hash::check(request('oldPassword'), Auth::user()->password)) == false) {
                    return $this->sendError("The old password is incorrect.");  
                } else if ((Hash::check(request('password'), Auth::user()->password)) == true) {
                    return $this->sendError("Please enter a password which is not similar then current password.");  
                } else {
                    User::where('id', $userid)->update(['password' => Hash::make($input['password'])]);
                    //$arr = array("status" => 200, "message" => "Password updated successfully.", "data" => array());
                    $success['email'] =  Auth::user()->email;
                    return $this->sendResponse($success, 'Password has been Updated Successfully.');
                }
            } catch (\Exception $ex) {
                if (isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                } else {
                    $msg = $ex->getMessage();
                }
                return $this->sendError($msg); 
            }
           // return \Response::json($arr);
        }
       
    }
	
	public function myCourses(Request $request)
    {
		$data = $request->all();
		$user = Auth::user();
		$currentDate = Carbon::now()->format('Y-m-d');
		$userSubscription = UserSubscription::with('course')->where("user_id",Auth::guard('api')->user()->id)->where("expired_on",">=",$currentDate)->where("status",'Success')->paginate(10);

		return $this->sendResponse($userSubscription, 'my Courses list.');

	}
	
	public function myCourseDetails(Request $request)
    {
        $data = $request->all();
		$currentDate = Carbon::now()->format('Y-m-d');
		$userSubscription = UserSubscription::where("user_id",Auth::guard('api')->user()->id)->where("course_id",$data['course_id']);
			if($userSubscription->count() == 0)
			{
				$errorMsg = "Something went wrong please try again.";       
				return $this->sendError($errorMsg); 
			}
			else
			{
				$subscription= $userSubscription->first();
				if($subscription->expired_on < $currentDate)
				{
					$errorMsg = "Your Course has been expired.Please purchase again.";       
					return $this->sendError($errorMsg); 
				}
			}
			
			
		if($data['course_id']=='')
		{
			$errorMsg = "Page not found";       
           return $this->sendError($errorMsg); 
		}
		else
		{	
			
			$course = Course::where(['id' => $data['course_id']])->withCount(['total_lesson','courseRating'])->withAvg('courseRating', 'rating')->with(['tutor','topics','topics.topicVideos'])->first(); 
			$returnData['course'] = $course;
			
			
			$review = Rating::where(['course_video_id' => $data['course_id']])->with(['user'])->paginate(3);
            
			$returnData['review'] = $review;
			$returnData['enrolled'] = 500;
			return $this->sendResponse($returnData, 'Course Details');
		}
       

    }
	
	
	public function ratingInsert(Request $request)
    {
        	$input = $request->all();
			$rating = Rating::where("course_video_id",$input["course_video_id"])->where("user_id",Auth::guard('api')->user()->id)->count();
			
			if($rating==0)
			{
			$rating = new Rating();
			$rating->user_id = Auth::guard('api')->user()->id;
			$rating->course_video_id = $input["course_video_id"];
			$rating->type = $input["type"];
			$rating->rating = $input["rating"];
			$rating->comment = $input["comment"];
			$rating->status = 1;
			$rating->save();
			return $this->sendResponse($rating, 'Thank you');
			}
			else
			{
			$errorMsg = "Already given";       
			return $this->sendError($errorMsg);
			}
       

    }
	
	
	
	public function flagVideo(Request $request)
    {
        	$input = $request->all();
			$flag = StudentFlag::where("video_id",$input["video_id"])->where("user_id",Auth::guard('api')->user()->id)->count();
			if($flag==0)
			{
			$flags = new StudentFlag();
			$flags->user_id = Auth::guard('api')->user()->id;
			$flags->video_id = $input["video_id"];
			$flags->comment = $input["comment"];
			$flags->save();
			return $this->sendResponse($flags, 'Video Flag successfully.');
			}
			else
			{
			$errorMsg = "Already given";       
			return $this->sendError($errorMsg);
			}
       
    }
	
	public function favoriteVideo(Request $request)
    {
        	$input = $request->all();
			$favourite = StudentFavourites::where("video_id",$input["video_id"])->where("user_id",Auth::guard('api')->user()->id)->count();
			if($favourite==0)
			{
			$favourites = new StudentFavourites();
			$favourites->user_id = Auth::guard('api')->user()->id;
			$favourites->course_id = $input["course_id"];
			$favourites->video_id = $input["video_id"];
			$favourites->save();
			return $this->sendResponse($favourites, 'Video favourite successfully.');
			}
			else
			{
			$favourite = StudentFavourites::where("video_id",$input["video_id"])->where("user_id",Auth::guard('api')->user()->id)->first();
			$favourite->delete();
			return $this->sendResponse([], 'Video un-favourite successfully.');
			}
       
    }
	
	public function favoriteFlag(Request $request)
    {
        $data = $request->all();
		
		if($data['video_id']=='')
		{
			$errorMsg = "Page not found";       
           return $this->sendError($errorMsg); 
		}
		else
		{	
			
			$returnData['flag'] = 0;
			$returnData['favourite'] = 0;
			
			$flag = StudentFlag::where("video_id",$data["video_id"])->where("user_id",Auth::guard('api')->user()->id)->first();
			$favourite = StudentFavourites::where("video_id",$data["video_id"])->where("user_id",Auth::guard('api')->user()->id)->first();
				if(isset($flag))
				{
					$returnData['flag'] = 1;
				}
				
				if(isset($favourite))
				{
					$returnData['favourite'] = 1;
				}

			
			return $this->sendResponse($returnData, 'flag  favourite Details');
		}
       

    }
	
	public function myFavoriteVideo(Request $request)
    {
        	$input = $request->all();
			$favourites = StudentFavourites::with("video")->where("user_id",Auth::guard('api')->user()->id)->paginate(10);
			
			return $this->sendResponse($favourites, 'My favourite videos.');
			
       
    }
	
    public function updateVideoTime(Request $request)
    {
        	$input = $request->all();
			$video = VideoWatchReport::where("user_id",Auth::guard('api')->user()->id)->where("course_id",$input['course_id'])->where("video_id",$input['video_id'])->first();
			if(isset($video))
            {
                $video->duration = $input['duration'];
                $video->percent = $input['percent'];
                $video->seconds = $input['seconds'];
                $video->save();
            }
            else{
                $video = new VideoWatchReport(); 
                $video->user_id = Auth::guard('api')->user()->id;
                $video->course_id = $input['course_id'];
                $video->video_id = $input['video_id'];
                $video->duration = $input['duration'];
                $video->percent = $input['percent'];
                $video->seconds = $input['seconds'];
            }

			return $this->sendResponse($video, 'videos time update.');
			
       
    }
    public function videoViewUpdate(Request $request)
    {
        	$input = $request->all();
			$homePageCategory = Video::where("id",$input["video_id"])->first();
			$total_views = $homePageCategory->total_views+1;
			$homePageCategory->total_views = $total_views;
			$homePageCategory->save();
			return $this->sendResponse($homePageCategory->total_views, 'Video View');
       

    }
    
	
	

}
<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Topic;
use App\Models\Video;
use App\Models\SubCategory;
use App\Models\UserSubscription;
use App\Models\VideoWatchReport;
use App\Models\Newsletter;
use App\Models\Rating;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;
use DB;
class VisitorController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

   
    public function newsletters()
    {
       
        if (!Gate::allows('isAdmin')) {
            return $this->unauthorizedResponse();
        }
        // $this->authorize('isAdmin');

        $users = Newsletter::latest()->paginate(10);

        return $this->sendResponse($users, 'Newsletter list');
    }
    public function deleteNewsletter($id)
    {
       
        if (!Gate::allows('isAdmin')) {
            return $this->unauthorizedResponse();
        }
        // $this->authorize('isAdmin');

        $newsletter = Newsletter::find($id);
        $newsletter->delete();

        return $this->sendResponse($newsletter, 'Newsletter deleted');
    }

    public function courseReview(Request $request)
    {
       
        if (!Gate::allows('isAdmin')) {
            return $this->unauthorizedResponse();
        }

        $data = $request->all();
        $query = Rating::where(['type' => 'course'])->with(['user','course']);
		if(isset($data['v_name']) && !empty($data['v_name']))
        {
            $query->whereHas('user', function($q) use($data){
                $q->where('name','like', '%'.$data['v_name'].'%');
            });
        }
		if(isset($data['c_id']) && !empty($data['c_id']))
        {
            $query->where('course_video_id', $data['c_id']);
        }
       

        $review = $query->paginate(50);
        return $this->sendResponse($review, 'User review list');
    }

    public function videoReview(Request $request)
    {
       
        if (!Gate::allows('isAdmin')) {
            return $this->unauthorizedResponse();
        }

        $data = $request->all();
        $query = Rating::where(['type' => 'video'])->with(['user','video','video.course']);
		if(isset($data['v_name']) && !empty($data['v_name']))
        {
            $query->whereHas('user', function($q) use($data){
                $q->where('name','like', '%'.$data['v_name'].'%');
            });
        }
        if(isset($data['c_id']) && !empty($data['c_id']))
        {
            $query->whereHas('video.course', function($q) use($data){
                $q->where('id', $data['c_id']);
            });
        }

        $review = $query->paginate(50);
        return $this->sendResponse($review, 'User review list');
    }

    public function statusUpdateReview(Request $request)
    {
       
        if (!Gate::allows('isAdmin')) {
            return $this->unauthorizedResponse();
        }
        // $this->authorize('isAdmin');

        $newsletter = Rating::find($request->get('id'));
        $newsletter->status = ($request->get('status') !== null)? $request->get('status'):0;
        $newsletter->save();

        return $this->sendResponse($newsletter, 'review status updated');
    }
    
    public function deleteReview(Request $request)
    {
       
        if (!Gate::allows('isAdmin')) {
            return $this->unauthorizedResponse();
        }
        // $this->authorize('isAdmin');

        $Rating = Rating::find($request->get('id'));
        $Rating->delete();

        return $this->sendResponse($Rating, 'Rating deleted');
    }

    public function courseWatchHours()
    {
       
        if (!Gate::allows('isAdmin')) {
            return $this->unauthorizedResponse();
        }

        $data = [];
        $courses = Course::get();
        foreach($courses as $course)
        {
            $videoWatchReport = VideoWatchReport::where(['course_id' => $course->id])->avg('seconds');
            $data[] = ['name'=>$course->name,'avg'=>number_format($videoWatchReport/3600,2)];
        }
        

        return $this->sendResponse($data, 'data avg');
    }

   

    public function courseCompleteStudent(Request $request)
    {
       
        if (!Gate::allows('isAdmin')) {
            return $this->unauthorizedResponse();
        }
        $data = $request->all();
		
        $query = DB::table('video_watch_report')
    ->leftjoin('users as u','u.id','=','video_watch_report.user_id')
    ->leftjoin('courses as c','video_watch_report.course_id','=','c.id')
    ->selectRaw('video_watch_report.*')
    ->selectRaw('video_watch_report.user_id as uid')
    ->selectRaw('c.name as cname')
    ->selectRaw('c.total_video_sum as total_video_sum')
    ->selectRaw('u.name as uname')
    ->selectRaw('u.email as uemail')
    ->selectRaw('COUNT(percent) as p');

        if(isset($data['v_name']) && !empty($data['v_name']))
        {
                $query->where('u.name','like', '%'.$data['v_name'].'%');
        }
        if(isset($data['v_email']) && !empty($data['v_email']))
        {
                $query->where('u.email','like', '%'.$data['v_email'].'%');
        }
        if(isset($data['c_id']) && !empty($data['c_id']))
        {
        $query->where('video_watch_report.course_id', $data['c_id']);
        }

        $users = $query->groupBy('cname')->groupBy('uname')->paginate(50);

        return $this->sendResponse($users, 'User VideoWatchReport list');
    }
}

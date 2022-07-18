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

    public function courseReview()
    {
       
        if (!Gate::allows('isAdmin')) {
            return $this->unauthorizedResponse();
        }

        $review = Rating::where(['type' => 'course'])->with(['user','course'])->latest()->paginate(5);

        return $this->sendResponse($review, 'User review list');
    }

    public function videoReview()
    {
       
        if (!Gate::allows('isAdmin')) {
            return $this->unauthorizedResponse();
        }

        $review = Rating::where(['type' => 'video'])->with(['user','video','video.course'])->latest()->paginate(5);

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

   

    public function courseCompleteStudent()
    {
       
        if (!Gate::allows('isAdmin')) {
            return $this->unauthorizedResponse();
        }
        // $this->authorize('isAdmin');

        //$users = DB::table('video_watch_report')->groupBy('video_watch_report.user_id')->get();
        //$users = VideoWatchReport::with(["course","user"])->groupBy('user_id')->get();
        //$sql = "select vw.*,c.name ascname,u.name,AVG(percent) as p from video_watch_report as vw left join users as u ON(u.id=vw.user_id) left join courses c ON(vw.course_id=c.id) group by u.name;";
        //$users = DB::statement($sql);
        $users = DB::table('video_watch_report')
    ->leftjoin('users as u','u.id','=','video_watch_report.user_id')
    ->leftjoin('courses as c','video_watch_report.course_id','=','c.id')
    ->selectRaw('video_watch_report.*')
    ->selectRaw('video_watch_report.user_id as uid')
    ->selectRaw('c.name as cname')
    ->selectRaw('u.name as uname')
    ->selectRaw('u.email as uemail')
    ->selectRaw('AVG(percent) as p')
    ->groupBy('cname')
    ->groupBy('uname')
    ->paginate(50);

        return $this->sendResponse($users, 'User VideoWatchReport list');
    }
}

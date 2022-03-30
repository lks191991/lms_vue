<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Video;

use Illuminate\Http\Request;
use App\Http\Requests\Products\VideoRequest;
use Validator;
use Illuminate\Validation\Rule;

class VideoController extends BaseController
{
    protected $video = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Video $video)
    {
        $this->middleware('auth:api');
        $this->video = $video;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = $this->video->latest()->paginate(10);

        return $this->sendResponse($videos, 'videos list');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $videos = $this->video->pluck('name', 'id');

        return $this->sendResponse($videos, 'video list');
    }


    /**
     * Store a newly created resource in storage.
     *
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(VideoRequest $request)
    {
		$video = new Video();
		
		 /** Below code for save banner_image * */
       
			$video->name  =  $request->get('name');
			$video->course_id =  $request->get('course_id');
			$video->video_url =  $request->get('video_url');
			$video->topic_id   =  $request->get('topic_id ');
			$video->tutor_id =  $request->get('tutor_id');
			$video->user_id =  auth()->user()->id;
			$video->description  =  $request->get('description');
			$video->status = ($request->get('status') !== null)? $request->get('status'):0;
			$video->save();
		
        

        return $this->sendResponse($course, 'Video Created Successfully');
    }

    /**
     * Update the resource in storage
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(VideoRequest $request)
    {
		
        $video = $this->video->findOrFail($request->id);
		
        $video->name  =  $request->get('name');
        $video->course_id =  $request->get('course_id');
        $video->video_url =  $request->get('video_url');
        $video->topic_id   =  $request->get('topic_id ');
        $video->tutor_id =  $request->get('tutor_id');
        $video->description  =  $request->get('description');
        $video->status = ($request->get('status') !== null)? $request->get('status'):0;
        $video->save();

        return $this->sendResponse($course, 'Video Information has been updated');
    }

    public function destroy($id)
    {

        $this->authorize('isAdmin');

        $video = $this->video->findOrFail($id);

        $video->delete();

        return $this->sendResponse($video, 'Course has been Deleted');
    }
}

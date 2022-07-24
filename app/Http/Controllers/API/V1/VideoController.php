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
    public function index(Request $request)
    {
        $data = $request->all();
		$query = $this->video->latest()->with('course','topic','user');
		if(isset($data['v_name']) && !empty($data['v_name']))
        {
            $query->where('name','like', '%'.$data['v_name'].'%');
        }
		if(isset($data['c_id']) && !empty($data['c_id']))
        {
            $query->where('course_id', $data['c_id']);
        }
        if(isset($data['t_id']) && !empty($data['t_id']))
        {
            $query->where('topic_id', $data['t_id']);
        }

        $videos = $query->paginate(50);
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
		
		
            if ($request->hasFile('video_note')) {

                $validator = Validator::make($request->all(), [
                            'video_note' => 'mimes:pdf|max:2048',
                                ], [
                            'video_note.max' => 'The banner image may not be greater than 2 mb.',
                ]);
                if ($validator->fails()) {
                        return response()->json([
                        'success' => false,
                        'message' => 'The banner image must be an image.',
                        'errors' => $validator->errors()
                        ], 422);
                }
    
                $destinationPath = public_path('/uploads/video_note/');
                $newName = '';
                $fileName = $request->all()['video_note']->getClientOriginalName();
                $file = request()->file('video_note');
                $fileNameArr = explode('.', $fileName);
                $fileNameExt = end($fileNameArr);
                $newName = date('His') . rand() . time() . '__' . $fileNameArr[0] . '.' . $fileNameExt;
    
                $file->move($destinationPath, $newName);
                
                $imagePath = 'uploads/video_note/' . $newName;
                $video->video_note = $imagePath;
            }

			$video->name  =  $request->get('name');
			$video->course_id =  $request->get('course_id');
			$video->video_url =  $request->get('video_url');
			$video->topic_id   =  $request->get('topic_id');
			$video->user_id =  auth()->user()->id;
			$video->description  =  $request->get('description');
			//$video->status = ($request->get('status') !== null)? $request->get('status'):0;
			$video->save();
		
        

        return $this->sendResponse($video, 'Video Created Successfully');
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
		/** Below code for save banner_image * */
		 

        if ($request->hasFile('video_note')) {

			$validator = Validator::make($request->all(), [
                        'video_note' => 'mimes:pdf|max:2048',
                            ], [
                        'video_note.max' => 'The banner image may not be greater than 2 mb.',
            ]);
			if ($validator->fails()) {
					return response()->json([
					'success' => false,
					'message' => 'The banner image must be an image.',
					'errors' => $validator->errors()
					], 422);
            }

            $destinationPath = public_path('/uploads/video_note/');
            $newName = '';
            $fileName = $request->all()['video_note']->getClientOriginalName();
            $file = request()->file('video_note');
            $fileNameArr = explode('.', $fileName);
            $fileNameExt = end($fileNameArr);
            $newName = date('His') . rand() . time() . '__' . $fileNameArr[0] . '.' . $fileNameExt;

            $file->move($destinationPath, $newName);
			
            $imagePath = 'uploads/video_note/' . $newName;
            $video->video_note = $imagePath;
        }
		
        $video->name  =  $request->get('name');
        $video->course_id =  $request->get('course_id');
        $video->video_url =  $request->get('video_url');
        $video->topic_id   =  $request->get('topic_id');
        $video->description  =  $request->get('description');
       // $video->status = ($request->get('status') !== null)? $request->get('status'):0;
        $video->save();

        return $this->sendResponse($video, 'Video Information has been updated');
    }

    public function destroy($id)
    {

        $this->authorize('isAdmin');

        $video = $this->video->findOrFail($id);

        $video->delete();

        return $this->sendResponse($video, 'video has been Deleted');
    }
}

<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Requests\Products\TopicRequest;

class TopicController extends BaseController
{
    protected $topic = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Topic $topic)
    {
        $this->middleware('auth:api');
        $this->topic = $topic;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		$data = $request->all();
		$query = $this->topic->latest()->with('course');
		if(isset($data['t_name']) && !empty($data['t_name']))
        {
            $query->where('name','like', '%'.$data['t_name'].'%');
        }
		if(isset($data['c_name']) && !empty($data['c_name']))
        {
            $query->where('course_id', $data['c_name']);
        }
        $topics = $query->orderBy('name', 'ASC')->paginate(50);
		

        return $this->sendResponse($topics, 'Topic list');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $topics = $this->topic->pluck('name', 'id');

        return $this->sendResponse($topics, 'topic list');
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
    public function store(TopicRequest $request)
    {
        $tag = $this->topic->create([
            'name' => $request->get('name'),
			'course_id' => $request->get('course_id'),
            'description' => $request->get('description'),
			'status' => ($request->get('status') !== null)? $request->get('status'):0,
        ]);

        return $this->sendResponse($tag, 'Topic Created Successfully');
    }

    /**
     * Update the resource in storage
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(TopicRequest $request, $id)
    {
        $tag = $this->topic->findOrFail($id);

        $tag->update($request->all());

        return $this->sendResponse($tag, 'Topic Information has been updated');
    }

    public function destroy($id)
    {

        $this->authorize('isAdmin');

        $topic = $this->topic->findOrFail($id);

        $topic->delete();

        return $this->sendResponse($category, 'Topic has been Deleted');
    }
}

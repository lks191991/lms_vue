<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Topic;
use App\Models\Video;
use App\Models\QnsAns;
use Illuminate\Http\Request;
use App\Http\Requests\Products\QuestionRequest;

class QnsAnsController extends BaseController
{
    protected $qnsans = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(QnsAns $qnsans)
    {
        $this->middleware('auth:api');
        $this->qnsans = $qnsans;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->all();
		$query = $this->qnsans->latest()->with('course','topic','video');
		if(isset($data['v_name']) && !empty($data['v_name']))
        {
            $query->where('question','like', '%'.$data['v_name'].'%');
        }
		if(isset($data['c_id']) && !empty($data['c_id']))
        {
            $query->where('course_id', $data['c_id']);
        }
        if(isset($data['t_id']) && !empty($data['t_id']))
        {
            $query->where('topic_id', $data['t_id']);
        }

        $results = $query->paginate(50);
        return $this->sendResponse($results, 'Question list');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $categories = $this->subCategory->pluck('name', 'id');

        return $this->sendResponse($categories, 'Question list');
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
    public function store(QuestionRequest $request)
    {
        $tag = $this->qnsans->create([
            'course_id' => $request->get('course_id'),
            'topic_id' => $request->get('topic_id'),
            'video_id' => $request->get('video_id'),
            'question' => $request->get('question'),
            'ans1' => $request->get('ans1'),
			'ans2' => $request->get('ans2'),
            'ans3' => $request->get('ans3'),
            'ans4' => $request->get('ans4'),
            'ans4' => $request->get('ans4'),
            'user_id' =>  auth()->user()->id,
            'rightans' => $request->get('rightans'),
            //'status' => ($request->get('status') !== null)? $request->get('status'):0,
        ]);

        return $this->sendResponse($tag, 'Question Created Successfully');
    }

    /**
     * Update the resource in storage
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(QuestionRequest $request, $id)
    {
        $tag = $this->qnsans->findOrFail($id);

        $tag->update($request->all());

        return $this->sendResponse($tag, 'Question Information has been updated');
    }

    public function destroy($id)
    {

        $this->authorize('isAdmin');

        $data = $this->qnsans->findOrFail($id);

        $data->delete();

        return $this->sendResponse($data, 'Question has been Deleted');
    }
}

<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Course;
use App\Models\Topic;
use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Requests\Products\SubCategoryRequest;

class CommonController extends BaseController
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Course $Course)
    {
        $this->middleware('auth:api');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCategorySelect(Request $request)
    {
        $categories = Category::pluck('name', 'id');

        return $this->sendResponse($categories, 'categories list');
    }
	
	public function getSubCategorySelect(Request $request)
    {
		$data = $request->all();
		if(isset($data['category']) && !empty($data['category']))
		{
			$subCategories = SubCategory::where('category_id',$data['category'])->pluck('name', 'id');
		}
		else
		{
			$subCategories = SubCategory::pluck('name', 'id');
		}
        

        return $this->sendResponse($subCategories, 'Sub Categories list');
    }
	
	public function getCoursesSelect(Request $request)
    {
		$data = $request->all();
		if(isset($data['category']) && !empty($data['category']))
		{
			$courses = Course::where('category_id',$data['category'])->pluck('name', 'id');
		}
		elseif(isset($data['sub_category']) && !empty($data['sub_category']))
		{
			$courses = Course::where('sub_category_id',$data['sub_category'])->pluck('name', 'id');
		}
		else
		{
			$courses = Course::pluck('name', 'id');
		}
		
        return $this->sendResponse($courses, 'Courses list');
    }

    public function getTopicByCourseSelect(Request $request)
    {
		$data = $request->all();
		if(isset($data['course']) && !empty($data['course']))
		{
			$courses = Topic::where('course_id',$data['course'])->pluck('name', 'id');
		}
		else
		{
			$courses = Topic::pluck('name', 'id');
		}
		
        return $this->sendResponse($courses, 'Topic list');
    }

	public function getVideoByTopicSelect(Request $request)
    {
		$data = $request->all();
		if(isset($data['topic']) && !empty($data['topic']))
		{
			$videos = Video::where('topic_id',$data['topic'])->pluck('name', 'id');
		}
		else
		{
			$videos = Video::pluck('name', 'id');
		}
		
        return $this->sendResponse($videos, 'Topic list');
    }

}

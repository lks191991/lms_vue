<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Requests\Products\CourseRequest;
use Validator;
use Illuminate\Validation\Rule;

class CourseController extends BaseController
{
    protected $course = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Course $course)
    {
        $this->middleware('auth:api');
        $this->course = $course;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = $this->course->latest()->with('category','subcategory')->paginate(10);

        return $this->sendResponse($courses, 'Courses list');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $courses = $this->course->pluck('name', 'id');

        return $this->sendResponse($courses, 'course list');
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
    public function store(CourseRequest $request)
    {
		$course = new Course();
		
		 /** Below code for save banner_image * */
        if ($request->hasFile('banner_image')) {

            $destinationPath = public_path('/uploads/course/');
            $newName = '';
            $fileName = $request->all()['banner_image']->getClientOriginalName();
            $file = request()->file('banner_image');
            $fileNameArr = explode('.', $fileName);
            $fileNameExt = end($fileNameArr);
            $newName = date('His') . rand() . time() . '__' . $fileNameArr[0] . '.' . $fileNameExt;

            $file->move($destinationPath, $newName);

            $imagePath = 'uploads/course/' . $newName;
            $course->banner_image = $imagePath;
        }
		
			$course->name  =  $request->get('name');
			$course->category_id =  $request->get('category_id');
			$course->sub_category_id =  $request->get('sub_category_id');
			$course->price  =  $request->get('price');
			$course->course_type =  $request->get('course_type');
			$course->demo_url =  $request->get('demo_url');
			$course->description  =  $request->get('description');
			$course->status = ($request->get('status') !== null)? $request->get('status'):0;
			$course->save();
		
        

        return $this->sendResponse($course, 'Course Created Successfully');
    }

    /**
     * Update the resource in storage
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(CourseRequest $request, $id)
    {
		
        $course = $this->course->findOrFail($id);
		 /** Below code for save banner_image * */
        if ($request->hasFile('banner_image')) {

            $destinationPath = public_path('/uploads/course/');
            $newName = '';
            $fileName = $request->all()['banner_image']->getClientOriginalName();
            $file = request()->file('banner_image');
            $fileNameArr = explode('.', $fileName);
            $fileNameExt = end($fileNameArr);
            $newName = date('His') . rand() . time() . '__' . $fileNameArr[0] . '.' . $fileNameExt;

            $file->move($destinationPath, $newName);

            $imagePath = 'uploads/course/' . $newName;
            $course->banner_image = $imagePath;
        }
		
			$course->name  =  $request->get('name');
			$course->category_id =  $request->get('category_id');
			$course->sub_category_id =  $request->get('sub_category_id');
			$course->price  =  $request->get('price');
			$course->course_type =  $request->get('course_type');
			$course->demo_url =  $request->get('demo_url');
			$course->description  =  $request->get('description');
			$course->status = ($request->get('status') !== null)? $request->get('status'):0;
			$course->save();

        return $this->sendResponse($tag, 'Course Information has been updated');
    }

    public function destroy($id)
    {

        $this->authorize('isAdmin');

        $category = $this->course->findOrFail($id);

        $category->delete();

        return $this->sendResponse($category, 'Course has been Deleted');
    }
}

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
    public function index(Request $request)
    {
		$data = $request->all();
		$query = $this->course->latest()->with('category','subcategory');
		if(isset($data['c_name']) && !empty($data['c_name']))
        {
            $query->where('name','like', '%'.$data['c_name'].'%');
        }
		if(isset($data['c_cat']) && !empty($data['c_cat']))
        {
            $query->where('sub_category_id', $data['c_cat']);
        }
        $courses = $query->orderBy('name', 'ASC')->paginate(50);

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

			$validator = Validator::make($request->all(), [
                        'banner_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                            ], [
                        'banner_image.max' => 'The banner image may not be greater than 2 mb.',
            ]);
			if ($validator->fails()) {
					return response()->json([
					'success' => false,
					'message' => 'The banner image must be an image.',
					'errors' => $validator->errors()
					], 422);
            }

            $destinationPath = public_path('/uploads/course/');
            $newName = '';
            $fileName = $request->all()['banner_image']->getClientOriginalName();
            $file = request()->file('banner_image');
            $fileNameArr = explode('.', $fileName);
            $fileNameExt = end($fileNameArr);
            $newName = rand() . time() .'.' . $fileNameExt;

            $file->move($destinationPath, $newName);
			
            $imagePath = 'uploads/course/' . $newName;
            $course->banner_image = $imagePath;
        }
		
			$course->name  =  $request->get('name');
			$course->category_id =  $request->get('category_id');
			$course->sub_category_id =  $request->get('sub_category_id');
			$course->total_length_minutes =  $request->get('total_length_minutes');
			$course->price  =  $request->get('price');
			$course->course_type =  $request->get('course_type');
			$course->demo_url =  $request->get('demo_url');
            $course->user_id =  auth()->user()->id;
			$course->description  =  $request->get('description');
			//$course->status = ($request->get('status') !== null)? $request->get('status'):0;
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
    public function update(CourseRequest $request)
    {
		
        $course = $this->course->findOrFail($request->id);
		 /** Below code for save banner_image * */
        if ($request->hasFile('banner_image')) {
			 
			
			$validator = Validator::make($request->all(), [
                        'banner_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                            ], [
                        'banner_image.max' => 'The banner image may not be greater than 2 mb.',
            ]);
			if ($validator->fails()) {
					return response()->json([
					'success' => false,
					'message' => 'The banner image must be an image.',
					'errors' => $validator->errors()
					], 422);
            }
			
            $destinationPath = public_path('/uploads/course/');
            $newName = '';
            $fileName = $request->all()['banner_image']->getClientOriginalName();
            $file = request()->file('banner_image');
            $fileNameArr = explode('.', $fileName);
            $fileNameExt = end($fileNameArr);
            $newName = rand() . time() .'.' . $fileNameExt;

            $file->move($destinationPath, $newName);
			$oldImage = public_path($course->banner_image);
            if (!empty($course->banner_image) && file_exists($oldImage)) {
                unlink($oldImage);
            }
            $imagePath = 'uploads/course/' . $newName;
            $course->banner_image = $imagePath;
        }
		
		
			$course->name  =  $request->get('name');
			$course->category_id =  $request->get('category_id');
			$course->sub_category_id =  $request->get('sub_category_id');
			$course->price  =  $request->get('price');
			$course->course_type =  $request->get('course_type');
			$course->demo_url =  $request->get('demo_url');
			$course->total_length_minutes =  $request->get('total_length_minutes');
			$course->description  =  $request->get('description');
            
			//$course->status = ($request->get('status') !== null)? $request->get('status'):0;
			$course->save();

        return $this->sendResponse($course, 'Course Information has been updated');
    }
    public function show()
    {
		
      
    }
    public function destroy($id)
    {

        $this->authorize('isAdmin');

        $category = $this->course->findOrFail($id);

        $category->delete();

        return $this->sendResponse($category, 'Course has been Deleted');
    }
}

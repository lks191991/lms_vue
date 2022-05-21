<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Slider;

use Illuminate\Http\Request;
use App\Http\Requests\Products\SliderRequest;
use Validator;
use Illuminate\Validation\Rule;

class SliderController extends BaseController
{
    protected $slider = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Slider $slider)
    {
        $this->middleware('auth:api');
        $this->slider = $slider;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = $this->slider->with('course')->latest()->paginate(10);

        return $this->sendResponse($sliders, 'slider list');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $sliders = $this->slider->pluck('name', 'id');

        return $this->sendResponse($sliders, 'slider list');
    }
    public function show()
    {
       
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
    public function store(SliderRequest $request)
    {
			$slider = new Slider();
		
		/** Below code for save banner_image * */
		 

        if ($request->hasFile('slider_image')) {

			$validator = Validator::make($request->all(), [
                        'slider_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                            ], [
                        'slider_image.max' => 'The banner image may not be greater than 2 mb.',
            ]);
			if ($validator->fails()) {
					return response()->json([
					'success' => false,
					'message' => 'The banner image must be an image.',
					'errors' => $validator->errors()
					], 422);
            }

            $destinationPath = public_path('/uploads/slider/');
            $newName = '';
            $fileName = $request->all()['slider_image']->getClientOriginalName();
            $file = request()->file('slider_image');
            $fileNameArr = explode('.', $fileName);
            $fileNameExt = end($fileNameArr);
            $newName = date('His') . rand() . time() . '__' . $fileNameArr[0] . '.' . $fileNameExt;

            $file->move($destinationPath, $newName);
			
            $imagePath = 'uploads/slider/' . $newName;
            $slider->slider_image = $imagePath;
        }
			
			$slider->name  =  $request->get('name');
			$slider->description  =  $request->get('description');
			//$video->status = ($request->get('status') !== null)? $request->get('status'):0;
			$slider->save();
		
        

        return $this->sendResponse($slider, 'Video Created Successfully');
    }

    /**
     * Update the resource in storage
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(SliderRequest $request)
    {
		
        $slider = $this->slider->findOrFail($request->id);
		/** Below code for save banner_image * */
		 

        if ($request->hasFile('slider_image')) {

			$validator = Validator::make($request->all(), [
                        'slider_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                            ], [
                        'slider_image.max' => 'The banner image may not be greater than 2 mb.',
            ]);
			if ($validator->fails()) {
					return response()->json([
					'success' => false,
					'message' => 'The banner image must be an image.',
					'errors' => $validator->errors()
					], 422);
            }

            $destinationPath = public_path('/uploads/slider/');
            $newName = '';
            $fileName = $request->all()['slider_image']->getClientOriginalName();
            $file = request()->file('slider_image');
            $fileNameArr = explode('.', $fileName);
            $fileNameExt = end($fileNameArr);
            $newName = date('His') . rand() . time() . '__' . $fileNameArr[0] . '.' . $fileNameExt;

            $file->move($destinationPath, $newName);
			
            $imagePath = 'uploads/slider/' . $newName;
            $slider->slider_image = $imagePath;
        }
		
        $slider->name  =  $request->get('name');
        $slider->course_id =  $request->get('course_id');
        $slider->description  =  $request->get('description');
       // $slider->status = ($request->get('status') !== null)? $request->get('status'):0;
        $slider->save();

        return $this->sendResponse($slider, 'Slider Information has been updated');
    }

    public function destroy($id)
    {

        $this->authorize('isAdmin');

        $slider = $this->slider->findOrFail($id);

        $slider->delete();

        return $this->sendResponse($slider, 'Slider has been Deleted');
    }
}

<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Requests\Products\SubCategoryRequest;

class SubCategoryController extends BaseController
{
    protected $subCategory = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SubCategory $subCategory)
    {
        $this->middleware('auth:api');
        $this->subCategory = $subCategory;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		$data = $request->all();
		$query = $this->subCategory->latest()->with('category');
		if(isset($data['keywords']) && !empty($data['keywords']))
        {
            $query->where('name','like', '%'.$data['keywords'].'%');
        }
		$categories = $query->orderBy('name', 'ASC')->paginate(50);
		

        return $this->sendResponse($categories, 'Category list');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $categories = $this->subCategory->pluck('name', 'id');

        return $this->sendResponse($categories, 'Category list');
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
    public function store(SubCategoryRequest $request)
    {
        $tag = $this->subCategory->create([
            'name' => $request->get('name'),
			'category_id' => $request->get('category_id'),
            'description' => $request->get('description'),
        ]);

        return $this->sendResponse($tag, 'Sub Category Created Successfully');
    }

    /**
     * Update the resource in storage
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(SubCategoryRequest $request, $id)
    {
        $tag = $this->subCategory->findOrFail($id);

        $tag->update($request->all());

        return $this->sendResponse($tag, 'Sub Category Information has been updated');
    }

    public function destroy($id)
    {

        $this->authorize('isAdmin');

        $category = $this->subCategory->findOrFail($id);

        $category->delete();

        return $this->sendResponse($category, 'Sub Category has been Deleted');
    }
}

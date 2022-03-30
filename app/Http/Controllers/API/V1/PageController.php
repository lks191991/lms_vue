<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends BaseController
{
    protected $page = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Page $page)
    {
        $this->middleware('auth:api');
        $this->page = $page;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = $this->page->paginate(10);

        return $this->sendResponse($pages, 'page list');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $pages = $this->page->get(['name', 'id']);

        return $this->sendResponse($page, 'page list');
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
    public function store(Request $request)
    {
        
    }

    /**
     * Update the resource in storage
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => [
                'required',
                'max:255'
            ],   
                   
        ]);

        $page = $this->page->findOrFail($id);
        $title = str_replace("'", "\'", $request->input('title'));
        $title = str_replace('"', "'+String.fromCharCode(34)+'",$request->input('title'));
        $page_content = str_replace("'", "\'", $request->input('page_content'));
        $page_content = str_replace('"', "'+String.fromCharCode(34)+'", $request->input('page_content'));

        $title = addslashes(trim(ucwords(strtolower($title))));
        $page_content = addslashes(trim(ucwords(strtolower($page_content))));

        //echo "<pre>"; print_r($school); exit;
        $page->title = $title;
        $page->page_content =$page_content;
        $page->save(); //persist the data

        return $this->sendResponse($page, 'Page Information has been updated');
    }
}

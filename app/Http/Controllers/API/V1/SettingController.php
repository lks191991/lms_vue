<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Requests\Products\TopicRequest;

class SettingController extends BaseController
{
    protected $setting = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Setting $setting)
    {
        $this->middleware('auth:api');
        $this->setting = $setting;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data = $this->setting->get();
        $settings=[];
        foreach($data as $d)
        {
            $settings[$d->key_name] = $d->val;
        }

        return $this->sendResponse($settings, 'setting list');
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
        $data = $request->all();
		
		
		
		foreach($data  as $key=>$val) {
			
			if($key != '_token') {
				$setting = Setting::where('key_name', $key)->first();
				$setting->key_name = $key;
				$setting->val = $val;
				$setting->updated_at = date('Y-m-d H:i:s');
				$setting->save();
			}
			
		}

        return $this->sendResponse($setting, 'setting Updated Successfully');
    }

    
}

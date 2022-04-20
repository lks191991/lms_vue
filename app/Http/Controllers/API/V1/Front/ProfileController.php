<?php
   
namespace App\Http\Controllers\API\V1\Front;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\V1\Front\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
   
class ProfileController extends BaseController
{
    
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Companylist api
     *
     * @return \Illuminate\Http\Response
     */

    public function profile()
    {
       $data = auth('api')->user();
       return $this->sendResponse($data, 'Profile retrieved successfully.');
    }

    public function notificationToggle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'is_notification' => 'required',

        ], [ ]);

        if($validator->fails()){
            $errors = $validator->errors();
            $errorMsg = '';
            if($errors->first('is_notification'))
                $errorMsg = $errors->first('is_notification');           
            return $this->sendError($errorMsg);        
         }

        $input = $request->all();
       $data = auth('api')->user();
       $user = User::find($data->id);
       $user->is_notification = $input['is_notification'];
       $user->save();
       $responce['is_notification'] = $user->is_notification;
       return $this->sendResponse($responce, 'Notification Toggle retrieved successfully.');  
    }


}
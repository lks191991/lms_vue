<?php
   
namespace App\Http\Controllers\API\V1\Front;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\V1\Front\BaseController as BaseController;
use App\Mail\sendAPIRegisterToTechnicianMailable;
use App\Mail\sendForgotPasswordToUserMailable;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Validator;
use Hash;
use DB;

class ForgotPasswordController extends BaseController
{
    
    public function forgotpassword(Request $request)
    { 	
        
		$data = $request->all();
		$validator = Validator::make($request->all(), [
            'email' => 'required',
            
        ],
        [
           
        ]);
        if($validator->fails()){
           //return $this->sendError('Validation Error.', $validator->errors()); 
           $errors = $validator->errors();
           $errorMsg = '';
           if($errors->first('email'))
                $errorMsg = $errors->first('email');
        
           return $this->sendError($errorMsg); 
           
        }
		$admin_details = DB::table('users')->where('email', $data['email'])->get();
		if(isset($admin_details[0]->id) && !empty($admin_details[0]->id)) {

           // $token = Str::random(5);
			$token = random_int(100000, 999999);
            $update_pass = DB::table('users')->where('id', $admin_details[0]->id)->update(['remember_token' => $token]);
			
            Mail::to($data['email'],'Password Reset Link')->send(new sendForgotPasswordToUserMailable($admin_details[0], $token,1));
			 return $this->sendResponse($data, 'Success! password reset OTP has been sent to your email.');
		} else {
			return $this->sendError('Email does not exists.');
		}
		
		
    }

    /**
     * Validate token for forgot password
     * @param token
     * @return view
     */
    public function forgotPasswordValidate($token)
    {
        //$user = User::where('remember_token', $token)->where('is_active', 0)->first();
        $user = User::where('remember_token', $token)->first();
        if ($user) {
            $email = $user->email;
			return $this->sendResponse($user, 'Success');
        }
		
		return $this->sendError('Password reset link is expired');
        
    }

    /**
     * Change password
     * @param request
     * @return response
     */
    public function updatePassword(Request $request) {
		
		$validator = Validator::make($request->all(), [
			'otp' => 'required',
            'password' => 'required|min:8|regex:/^(?=.*\d)(?=.*[A-Z])[\w\W]{8,}$/',
            //'confirm_password' => 'required|same:password|min:8'
            
        ],
        [
           
        ]);
        if($validator->fails()){
           //return $this->sendError('Validation Error.', $validator->errors()); 
           $errors = $validator->errors();
           $errorMsg = '';
           if($errors->first('otp'))
                $errorMsg = $errors->first('otp');
           elseif($errors->first('password'))
               $errorMsg = $errors->first('password'); 
         
           return $this->sendError($errorMsg); 
           
        }
      

        $user = User::where('remember_token', $request->otp)->first();
        if ($user) {
           //$user['is_active'] = 0;
            $user['remember_token'] = '';
            $user['password'] = Hash::make($request->password);
            $user->save();
            return $this->sendResponse($user, 'Success! password has been changed.');
            
        }
		
		return $this->sendError('Failed! something went wrong'); 
    }
	

}
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
use Image;
use GuzzleHttp\Client;
use Laravel\Passport\Client as OClient;
use Carbon\Carbon;

class RegisterController extends BaseController
{
    
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
       $options['allow_img_size'] = 10;
        $validator = Validator::make($request->all(), [
            'name' => 'required|sanitizeScripts|max:255',
            'contact' => 'required|sanitizeScripts|max:20',
            'email' => 'required|max:255|sanitizeScripts|email|unique:users|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'password' => 'required|max:255|sanitizeScripts|min:8',
            
        ],
        [
            'email.regex' => 'The email must be a valid email address.',
            'password.regex' => "Password contains At least one uppercase, At least one digit and At least it should have 8 characters long."
        ]);
   
        if($validator->fails()){
           //return $this->sendError('Validation Error.', $validator->errors()); 
           $errors = $validator->errors();
           $errorMsg = '';
           if($errors->first('name'))
                $errorMsg = $errors->first('name');
			 elseif($errors->first('email'))
               $errorMsg = $errors->first('email');
           elseif($errors->first('contact'))
               $errorMsg = $errors->first('contact'); 
           elseif($errors->first('email'))
               $errorMsg = $errors->first('email');               
           elseif($errors->first('password'))
               $errorMsg = $errors->first('password'); 
          
           return $this->sendError($errorMsg); 
           
        }

        $input = $request->all();
		$psw = $input['password'];
        $input['password'] = bcrypt($input['password']);
        $input['type'] = 'student';
        $input['contact'] = $input['contact'];
        $input['status'] = 1;
		$input['email_verified_at'] = Carbon::now()->getTimestamp();
        //pr($input); die;
        $user = User::create($input);
		$input['password'] = $psw;
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        $success['status'] =  1;
		$success['contact'] =  $user->contact;
        $success['email'] =  $user->email;
        //$oClient = OClient::where('password_client', 1)->first();
        //$success['TokenAndRefreshToken'] = $this->getTokenAndRefreshToken($oClient, request('email'), request('password'));
   
        Mail::to($input['email'],'Registration Email')->send(new sendAPIRegisterToTechnicianMailable($input));  
   
        return $this->sendResponse($success, 'User has been registered successfully.');
    }
   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */


    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|max:255|email',
            'password' => 'required|max:255',

        ],
        [
            'email.sanitize_scripts' => 'Invalid value entered for Email Address field.',
            'password.sanitize_scripts' => 'Invalid value entered for Password field.'
        ]);
   
        if($validator->fails()){
           //return $this->sendError('Validation Error.', $validator->errors()); 
           $errors = $validator->errors();
           $errorMsg = '';
           if($errors->first('email'))
               $errorMsg = $errors->first('email');           
           elseif($errors->first('password'))
               $errorMsg = $errors->first('password');  

            //echo $errorMsg;
           //return $this->sendError('Please enter login details correctly.');  
           return $this->sendError($errorMsg);        
        }

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
			
				
				$user1 = User::find($user->id);
				
				$user1->last_login = Carbon::now();
				$user1->save();
           $oClient = OClient::where('password_client', 1)->first();
           // $success['token'] =  $user->createToken('MyApp')->accessToken; 
            $success['name'] =  $user->name;
            $success['image'] =  $user->image;
            $success['email'] =  $user->email;
            $success['TokenAndRefreshToken'] = $this->getTokenAndRefreshToken($oClient, $request->email, $request->password);
   
            return $this->sendResponse($success, 'User login successfully.');
        }elseif(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            return $this->sendError('Oops!  Your account is inactive.');
        }else{ 
            return $this->sendError('Invalid login details.');
        } 
    }

    /**
     * forgot password api
     *
     * @return \Illuminate\Http\Response
     */
    public function forgotpassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|max:255|sanitizeScripts|email'
        ],
        [
            'email.sanitize_scripts' => 'Invalid value entered for Email Address field.'
        ]);
   
        if($validator->fails()){
           $errors = $validator->errors();
           $errorMsg = '';
           if($errors->first('email'))
               $errorMsg = $errors->first('email');           

           return $this->sendError($errorMsg);        
        }

        $data = $request->all();
        $admin_details = DB::table('users')->where('email', $data['email'])->get();
		//print_r($admin_details); die('test');
		if(isset($admin_details[0]->id) && !empty($admin_details[0]->id)) {

            $token = Str::random(60);
            $update_pass = DB::table('users')->where('id', $admin_details[0]->id)->update(['remember_token' => $token]);

            $success = (object)array();
            $success->email = $request->email;
          
            Mail::to($data['email'],'Password Reset Link')->send(new sendForgotPasswordToUserMailable($admin_details[0], $token));

            return $this->sendResponse($success, 'Success! password reset link has been sent to your email.');
           
		} else {
            return $this->sendError('Email does not exists.');
		}
    }

    
    public function getTokenAndRefreshToken(OClient $oClient, $email, $password) { 
        $oClient = OClient::where('password_client', 1)->first();
        $http = new Client;
        $response = $http->request('POST', env('OAUTHURL'), [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => $oClient->id,
                'client_secret' => $oClient->secret,
                'username' => $email,
                'password' => $password,
                'scope' => '*',
            ],
        ]);
        $result = json_decode((string) $response->getBody(), true);
        return response()->json($result);
    }
	
	/**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function tutorRegister(Request $request)
    {
        $options['allow_img_size'] = 10;
        $validator = Validator::make($request->all(), [
            'name' => 'required|sanitizeScripts|max:255',
            'contact' => 'required|sanitizeScripts|max:20',
            'email' => 'required|max:255|sanitizeScripts|email|unique:users|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'password' => 'required|max:255|sanitizeScripts|min:8',
            
        ],
        [
            'email.regex' => 'The email must be a valid email address.',
            'password.regex' => "Password contains At least one uppercase, At least one digit and At least it should have 8 characters long."
        ]);
   
        if($validator->fails()){
           //return $this->sendError('Validation Error.', $validator->errors()); 
           $errors = $validator->errors();
           $errorMsg = '';
           if($errors->first('name'))
                $errorMsg = $errors->first('name');
			 elseif($errors->first('email'))
               $errorMsg = $errors->first('email');
           elseif($errors->first('contact'))
               $errorMsg = $errors->first('contact'); 
           elseif($errors->first('email'))
               $errorMsg = $errors->first('email');               
           elseif($errors->first('password'))
               $errorMsg = $errors->first('password'); 
          
           return $this->sendError($errorMsg); 
           
        }

        $input = $request->all();
		$psw = $input['password'];
        $input['password'] = bcrypt($input['password']);
        $input['type'] = 'user';
        $input['contact'] = $input['contact'];
        $input['status'] = 1;
		$input['email_verified_at'] = Carbon::now()->getTimestamp();
        //pr($input); die;
        $user = User::create($input);
		$input['password'] = $psw;
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        $success['status'] =  1;
		$success['contact'] =  $user->contact;
        $success['email'] =  $user->email;
        //$oClient = OClient::where('password_client', 1)->first();
        //$success['TokenAndRefreshToken'] = $this->getTokenAndRefreshToken($oClient, request('email'), request('password'));
   
        Mail::to($input['email'],'Registration Email')->send(new sendAPIRegisterToTechnicianMailable($input));  
   
        return $this->sendResponse($success, 'User has been registered successfully.');
    }

}
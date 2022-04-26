<?php
   
namespace App\Http\Controllers\API\V1\Front;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\V1\Front\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;

class ProfileController extends BaseController
{
    
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    
    public function profile()
    {
       $data = auth('api')->user();
       return $this->sendResponse($data, 'Profile retrieved successfully.');
    }
	
	 public function editProfile(Request $request)
    {
        $options['allow_img_size'] = 10;
        $validator = Validator::make($request->all(), [
            'name' => 'required|sanitizeScripts|max:255',
            'contact' => 'required|sanitizeScripts|max:20',
            
        ],
        [
           
        ]);
   
        if($validator->fails()){
           //return $this->sendError('Validation Error.', $validator->errors()); 
           $errors = $validator->errors();
           $errorMsg = '';
           if($errors->first('name'))
                $errorMsg = $errors->first('name');
           elseif($errors->first('contact'))
               $errorMsg = $errors->first('contact'); 
         
           return $this->sendError($errorMsg); 
           
        }

        $input = $request->all();
        
        $userid = Auth::guard('api')->user()->id;
        $user = User::find($userid);
        $user->name = $input['name'];
        $user->contact = $input['contact'];
        $user->save();
        $success['name'] =  $user->name;
		$success['contact'] =  $user->contact;
        $success['image'] =  url('/uploads/users/'.$user->image);
        $success['email'] =  $user->email;
        
   
        return $this->sendResponse($success, 'Profile update successfully.');
    }
	
	 public function editProfileImage(Request $request)
    {
        $options['allow_img_size'] = 10;
        $validator = Validator::make($request->all(), [
             'image' => 'nullable|mimes:jpeg,jpg,png|max:' . ($options['allow_img_size'] * 1024),
            
        ],
        [
           
        ]);
   
        if($validator->fails()){
           $errors = $validator->errors();
           $errorMsg = '';
           if($errors->first('image'))
               $errorMsg = $errors->first('image');   
         
           return $this->sendError($errorMsg); 
           
        }

        $input = $request->all();
        /** Below code for save image **/
		$destinationPath = public_path('/uploads/users/');
		$newName = '';
		if ($request->hasFile('image')) {
           
			$fileName = $input['image']->getClientOriginalName();
			$file = request()->file('image');
			$fileNameArr = explode('.', $fileName);
			$fileNameExt = end($fileNameArr);
			$newName = date('His').rand() . time() . '.' . $fileNameExt;
			
			$file->move($destinationPath, $newName);
			
			//$user_config = json_decode($options['user'],true);
			
			$img = Image::make(public_path('/uploads/users/'.$newName));
						
            $img->resize(100, 100, function($constraint) {
				$constraint->aspectRatio();
			});
			

			$img->save(public_path('/uploads/users/thumb/'.$newName));
		}

        $input['image'] = $newName;
       
        //pr($input); die;
		$userid = Auth::guard('api')->user()->id;
        $user = User::find($userid);
		$user->image = $input['image'];
		$user->save();
        $success['image'] =  url('/uploads/users/'.$user->image);
        
   
        return $this->sendResponse($success, 'Profile image update successfully.');
    }
	
    /**
     * change password api
     *
     * @return \Illuminate\Http\Response
     */
    public function changepassword(Request $request)
    {
        //die('xvcx');

        $input = $request->all();
        $userid = Auth::guard('api')->user()->id;
        $validator = Validator::make($input, [
            'oldPassword' => 'required',
            'password' => 'required|min:8',
            'confirmPassword' => 'required|same:password',
        ],
        [
            'password.regex' => "Password contains At least one uppercase, At least one digit and At least it should have 8 characters long"
        ]);
        //$validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            //$arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
            $errors = $validator->errors();
            $errorMsg = '';
            if($errors->first('oldPassword'))
                $errorMsg = $errors->first('oldPassword'); 
            elseif($errors->first('password'))
                $errorMsg = $errors->first('password');  
            elseif($errors->first('confirmPassword'))
                $errorMsg = $errors->first('confirmPassword');           
 
            return $this->sendError($errorMsg);   
        } else {
            try {
                if ((Hash::check(request('oldPassword'), Auth::user()->password)) == false) {
                    return $this->sendError("The old password is incorrect.");  
                } else if ((Hash::check(request('password'), Auth::user()->password)) == true) {
                    return $this->sendError("Please enter a password which is not similar then current password.");  
                } else {
                    User::where('id', $userid)->update(['password' => Hash::make($input['password'])]);
                    //$arr = array("status" => 200, "message" => "Password updated successfully.", "data" => array());
                    $success['email'] =  Auth::user()->email;
                    return $this->sendResponse($success, 'Password has been Updated Successfully.');
                }
            } catch (\Exception $ex) {
                if (isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                } else {
                    $msg = $ex->getMessage();
                }
                return $this->sendError($msg); 
            }
           // return \Response::json($arr);
        }
       
    }


}
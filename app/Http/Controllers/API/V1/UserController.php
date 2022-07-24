<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\Users\UserRequest;
use App\Models\User;
use App\Models\Course;
use App\Models\Topic;
use App\Models\Video;
use App\Models\SubCategory;
use App\Models\UserSubscription;
use App\Models\Newsletter;
use App\Models\Rating;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function dashboard()
    {
        if (!Gate::allows('isAdmin')) {
            return $this->unauthorizedResponse();
        }
        // $this->authorize('isAdmin');

        $students = User::where("type",'student')->count();
        $tutors = User::where("type",'user')->count();
        $SubCategory = SubCategory::count();
        $courses = Course::count();
        $topics = Topic::count();
        $videos = Video::count();
        $paymentsSuccess = UserSubscription::where("status","Success")->sum("price");
        $paymentsFailed = UserSubscription::where("status","Failed")->sum("price");
        $data = [
            'students' =>$students,
            'tutors' =>$tutors,
            'courses' =>$courses,
            'topics' =>$topics,
            'videos' =>$videos,
            'paymentsSuccess' =>$paymentsSuccess,
            'paymentsFailed' =>$paymentsFailed,
            'SubCategory' =>$SubCategory,
            'transactions' =>$paymentsSuccess+$paymentsFailed,
        ];
        return $this->sendResponse($data, 'dashboard data');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::allows('isAdmin')) {
            return $this->unauthorizedResponse();
        }
        // $this->authorize('isAdmin');

        $users = User::latest()->paginate(10);

        return $this->sendResponse($users, 'admin list');
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function students(Request $request)
    {
      
       
        if (!Gate::allows('isAdmin')) {
            return $this->unauthorizedResponse();
        }
        // $this->authorize('isAdmin');

        $data = $request->all();
		$query = User::where("type",'student')->latest();
		if(isset($data['s_name']) && !empty($data['s_name']))
        {
            $query->where('name','like', '%'.$data['s_name'].'%');
        }
		if(isset($data['s_email']) && !empty($data['s_email']))
        {
            $query->where('email','like', '%'.$data['s_email'].'%');
        }

        $users = $query->paginate(50);


        return $this->sendResponse($users, 'Users list');
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function studentsLastLogin(Request $request)
    {
      
        if (!Gate::allows('isAdmin')) {
            return $this->unauthorizedResponse();
        }
        // $this->authorize('isAdmin');

        $data = $request->all();
		$query = User::where("type",'student')->where("last_login",'!=',NULL)->latest();
		if(isset($data['v_name']) && !empty($data['v_name']))
        {
            $query->where('name','like', '%'.$data['v_name'].'%');
        }
		if(isset($data['v_email']) && !empty($data['v_email']))
        {
            $query->where('email','like', '%'.$data['v_email'].'%');
        }

        $users = $query->paginate(50);
        return $this->sendResponse($users, 'Users list');
    }
    public function tutors(Request $request)
    {
       
        if (!Gate::allows('isAdmin')) {
            return $this->unauthorizedResponse();
        }
        // $this->authorize('isAdmin');
        $data = $request->all();
		$query = User::where("type",'user')->latest();
		if(isset($data['s_name']) && !empty($data['s_name']))
        {
            $query->where('name','like', '%'.$data['s_name'].'%');
        }
		if(isset($data['s_email']) && !empty($data['s_email']))
        {
            $query->where('email','like', '%'.$data['s_email'].'%');
        }

        $users = $query->paginate(50);

        return $this->sendResponse($users, 'Users list');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Users\UserRequest  $request
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(UserRequest $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'type' => $request['type'],
            'contact' => $request['contact'],
            'dob' => date("Y-m-d",strtotime($request['dob'])),
            'email_verified_at' =>  Carbon::now(),
            'status' => ($request->get('status') !== null)? $request->get('status'):0,
        ]);

        return $this->sendResponse($user, 'User Created Successfully');
    }

    /**
     * Update the resource in storage
     *
     * @param  \App\Http\Requests\Users\UserRequest  $request
     * @param $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        if (!empty($request->password)) {
            $request->merge(['password' => Hash::make($request['password'])]);
        }

        if (!empty($request->dob)) {
            $request->merge(['dob' => date("Y-m-d",strtotime($request['dob']))]);
        }
        
        $userData = [
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'type' => $request['type'],
            'contact' => $request['contact'],
            'dob' => date("Y-m-d",strtotime($request['dob'])),
            'email_verified_at' =>  Carbon::now(),
            'status' => ($request->get('status') !== null)? $request->get('status'):0,
        ];

        $user->update($userData);

        return $this->sendResponse($user, 'User Information has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $this->authorize('isAdmin');

        $user = User::findOrFail($id);
        // delete the user

        $user->delete();

        return $this->sendResponse([$user], 'User has been Deleted');
    }

   

    public function transactions(Request $request)
    {
       
        if (!Gate::allows('isAdmin')) {
            return $this->unauthorizedResponse();
        }
        // $this->authorize('isAdmin');

        $data = $request->all();
		$query = UserSubscription::with(["course","user"])->latest()->latest();
		if(isset($data['v_name']) && !empty($data['v_name']))
        {
            $query->whereHas('user', function($q) use($data){
                $q->where('name','like', '%'.$data['v_name'].'%');
            });
        }
        if(isset($data['t_id']) && !empty($data['t_id']))
        {
                $query->where('transaction_id','like', '%'.$data['t_id'].'%');
        }
        if(isset($data['v_email']) && !empty($data['v_email']))
        {
            $query->whereHas('user', function($q) use($data){
                $q->where('email','like', '%'.$data['v_email'].'%');
            });
        }
		if(isset($data['c_id']) && !empty($data['c_id']))
        {
            $query->where('course_id', $data['c_id']);
        }
        

        $users = $query->paginate(50);

        return $this->sendResponse($users, 'User Subscription list');
    }

   

    
}

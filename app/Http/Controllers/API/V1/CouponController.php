<?php

namespace App\Http\Controllers\API\V1;


use App\Models\Coupon;
use Illuminate\Http\Request;
//use App\Http\Requests\Products\CouponRequest;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class CouponController extends BaseController
{
    protected $coupon = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Coupon $coupon)
    {
        $this->middleware('auth:api');
        $this->coupon = $coupon;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = $this->coupon->latest()->paginate(10);

        return $this->sendResponse($coupons, 'coupons list');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $coupons = $this->coupon->pluck('name', 'id');

        return $this->sendResponse($coupons, 'course list');
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
		$coupon = new Coupon();
		
        $data = $request->all();
        if($data['coupon_type']=='fixed')
        {
            $this->validate($request, [
                'coupon_type' => 'required',    
                'name' => 'required|max:180', 
                'coupon_value' => 'required|min:1', 
                'expired_at' => 'required',         
            ]);
        }

        if($data['coupon_type']=='percent')
        {
            $this->validate($request, [
                'coupon_type' => 'required',    
                'name' => 'required|max:180', 
                'coupon_value' => 'required|integer|between:1,100', 
                'expired_at' => 'required',         
            ]);
        }
		
			
       if($data['quantity']>1)
        {
            for($i=1;$i<=$data['quantity'];$i++)
            {
               
                $random = Str::random(8);
                $couponCode = strtoupper($random);
                $coupon = new Coupon();
                $coupon->name = $request->input('name');
                $coupon->code = $couponCode;
                $coupon->type = $request->input('coupon_type');
                $coupon->coupon_value = $request->input('coupon_value');
                $coupon->expired_at =\Carbon\Carbon::parse($request->input('expired_at'))->format('Y-m-d');
                $coupon->save(); //persist the data
            }
           
        }
       else
        {
            $random = Str::random(8);
            $couponCode = strtoupper($random);
            $coupon = new Coupon();
            $coupon->name = $request->input('name');
            $coupon->code = $couponCode;
            $coupon->type = $request->input('coupon_type');
            $coupon->coupon_value = $request->input('coupon_value');
            $coupon->expired_at =\Carbon\Carbon::parse($request->input('expired_at'))->format('Y-m-d');
            $coupon->save(); //persist the data
        }
		 


        return $this->sendResponse([], 'Coupon Created Successfully');
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
		
      
    }

    public function destroy($id)
    {

        $this->authorize('isAdmin');

        $coupon = $this->coupon->findOrFail($id);

        $coupon->delete();

        return $this->sendResponse($coupon, 'Course has been Deleted');
    }
}

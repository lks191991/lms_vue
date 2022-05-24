<?php
   
namespace App\Http\Controllers\API\V1\Front;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\V1\Front\BaseController as BaseController;
use App\Models\User;
use App\Models\Course;
use App\Models\Coupon;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Image;
use Stripe;
use Carbon\Carbon;

class PaymentController extends BaseController
{
    
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    
    
	public function checkout(Request $request)
    {
		$data = $request->all();
		if($data['course_id']=='')
		{
			$errorMsg = "Page not found";       
           return $this->sendError($errorMsg); 
		}
		
		if(isset($data['code']) && !empty($data['code']))
		{

			$user = Auth::user();
			$dateExpired = date('d-m-Y');
			$course = Course::where(['id' => $data['course_id']])->first(); 
			
			$coursePrice = $course->price;
			$dateExpired = date('Y-m-d');
        	$coupon = Coupon::where("code",$data['code'])->whereDate('expired_at', '>=', $dateExpired)->where('used',0)->first();
        	
			if(isset($coupon) && !empty($coupon))
			{
				if($coupon->type == 'fixed'){
					$coupon_total =  $coupon->coupon_value;
				} elseif ($coupon->type == 'percent'){
					$coupon_total = ($coupon->coupon_value / 100) * $coursePrice;
				} else{
					$coupon_total = 0;
				}

				

				if($coupon_total >= $coursePrice)
				{
					$newPrice = 0;
					$dataReturn = ['course_id' => $data['course_id'],'price' => 0,'discount' => $coursePrice,'code' => $data['code'],'coupon_id' => $coupon->id,'courseDetails'=>$course];
				}
				else
				{
					$newPrice = $coursePrice-$coupon_total;
					$dataReturn = ['course_id' => $data['course_id'],'price' => $newPrice,'discount' => $coupon_total,'code' => $data['code'],'coupon_id' => $coupon->id,'courseDetails'=>$course];
				}

				return $this->sendResponse($dataReturn, 'Course Details');

				
			}
			else
			{
				$errorMsg = "Please Enter Valid Coupon Code.";       
				return $this->sendError($errorMsg); 
			
			}

			
		}
		else
		{
			$currentDate = Carbon::now()->format('Y-m-d');
			$userSubscription = UserSubscription::where("user_id",Auth::guard('api')->user()->id)->where("expired_on",">=",$currentDate)->where("course_id",$data['course_id'])->count();
			if($userSubscription > 0)
			{
				$errorMsg = "Course already in your learning aacount.";       
				return $this->sendError($errorMsg); 
			}
			else
			{
			$course = Course::where(['id' => $data['course_id']])->first(); 
			$dataReturn = ['course_id' => $data['course_id'],'price' => $course->price,'discount' => 0,'code' => '','coupon_id' => '','courseDetails'=>$course];
			return $this->sendResponse($dataReturn, 'Course Details');
			}
		}

		

	}

/**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
		$data = $request->all();
		if($data['course_id']=='')
		{
			$errorMsg = "Page not found";       
           return $this->sendError($errorMsg); 
		}
		
		$course = Course::where(['id' => $data['course_id']])->first(); 
		$user = Auth::user();
		
		$price = $data['finalAmount'];
		
		if($price > 0)
		{
			
		 $amount = $price * 100;
		 Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
			/* $customer = \Stripe\Customer::create(array( 
				'name' => $user->name,
				'email' => $user->email,
				'description' => $course->name,        
				'source'  => $request->stripe_token ,
				'address' => [
					'line1' => '510 Townsend St',
					'postal_code' => '98140',
					'city' => 'San Francisco',
					'state' => 'CA',
					'country' => 'US',
				  ],
		)); */
		$orderID = strtoupper(str_replace('.','',uniqid('', true))); 
		$result = \Stripe\Charge::create(array( 
			'source' =>  $request->stripe_token, 
			'amount'   => $amount, 
			'currency' => "usd", 
			'description' => $course->name, 
			'metadata' => array( 
				'order_id' => $orderID 
			) 
		));
		
		}
		else
		{
			$result['status'] = 'succeeded';
			$result['id'] = "Offer";
		}
		if($result['status'] == 'succeeded')
		{
			$expiringDate = Carbon::now()->addMonths(3)->format('Y-m-d');
			
				$coursePrice = $course->price;
				$userSubscription = new UserSubscription();
				$userSubscription->user_id = Auth::user()->id;
				$userSubscription->course_id = $course->id;
				$userSubscription->transaction_id = $result['id'];
				$userSubscription->price = $price;
				$userSubscription->status = 'Success';
				$userSubscription->expired_on = $expiringDate;
				
				if(isset($data['code']) && !empty($data['code']))
				{
					$coupon = Coupon::where("code",$data['code'])->where('used',0)->first();
					$coupon_total = 0;
					if(isset($coupon))
					{
						if($coupon->type == 'fixed'){
						$coupon_total =  $coupon->coupon_value;
						} elseif ($coupon->type == 'percent'){
						$coupon_total = ($coupon->coupon_value / 100) * $coursePrice;
						} 
					
						$userSubscription->cupon_code = $data['code'];
						$userSubscription->discount = $coupon_total;
						$userSubscription->cupon_id = $coupon->id;
						$coupon->used = 1;
						$coupon->save();
					
					}
				
				}
				
				$userSubscription->save();
				
			return $this->sendResponse($userSubscription, 'your payment has been successfully processed.');
				
		}
		else
		{		$userSubscription = new UserSubscription();
				$userSubscription->user_id = Auth::user()->id;
				$userSubscription->course_id = $course->id;
				$userSubscription->transaction_id = '0';
				$userSubscription->price = $price;
				$userSubscription->status = 'Faild';
				$userSubscription->save();
				$errorMsg = "your payment has been Faild.";       
				return $this->sendError($errorMsg); 
				
		}
		
    }
	
	public function myPayments(Request $request)
    {
		$data = $request->all();
		$user = Auth::user();
		$userSubscription = UserSubscription::with('course')->where("user_id",Auth::guard('api')->user()->id)->paginate(10);

		return $this->sendResponse($userSubscription, 'your payment list.');

	}
	
	

}
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('version', function () {
    return response()->json(['version' => config('app.version')]);
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    Log::debug('User:' . serialize($request->user()));
    return $request->user();
});

Route::namespace('App\\Http\\Controllers\\API\V1\Front')->group(function () {
	Route::post('login', 'RegisterController@login');
	Route::post('register', 'RegisterController@register');
	Route::post('forgotpassword', 'RegisterController@forgotpassword');
	Route::get('page/{id}', 'PageController@index');
	Route::get('setting', 'PageController@setting');
	Route::get('nav-course-menu', 'PageController@courseMenu');
    Route::get('home-category', 'PageController@homePageCategory');
	Route::get('home-slider', 'PageController@homeSlider');
	Route::get('home-page-course', 'PageController@homePageCourse');
	Route::post('all-courses', 'PageController@allCourses');
	Route::post('course-by-subcategory', 'PageController@courseByCategory');
	Route::post('course-details', 'PageController@courseDetails');
    Route::post('contact-us', 'PageController@sendContact');
    Route::post('save-newsletter', 'PageController@saveNewsletter');
    Route::post('course-view-update', 'PageController@courseViewUpdate');
	

	Route::middleware(['auth:api'])->group(function () {
		Route::post('change_password', 'ProfileController@changepassword');
		Route::post('change-profile', 'ProfileController@editProfile');
		Route::post('change-profile-image', 'ProfileController@editProfileImage');
		Route::post('profile', 'ProfileController@profile');
		Route::post('checkout', 'PaymentController@checkout');
		Route::post('payment', 'PaymentController@stripePost');
		Route::post('my-payment', 'PaymentController@myPayments');
		Route::post('my-courses', 'ProfileController@myCourses');
		Route::post('my-course-details', 'ProfileController@myCourseDetails');
		Route::post('video-view-update', 'ProfileController@videoViewUpdate');
		Route::post('give-rating', 'ProfileController@ratingInsert');
		Route::post('flag-video', 'ProfileController@flagVideo');
		Route::post('favorite-video', 'ProfileController@favoriteVideo');
		Route::post('favorite-flag', 'ProfileController@favoriteFlag');
		Route::post('my-favorites', 'ProfileController@myFavoriteVideo');
		Route::post('update-video-time', 'ProfileController@updateVideoTime');
	});
});

Route::namespace('App\\Http\\Controllers\\API\V1')->group(function () {
	
	Route::get('get-category', 'CommonController@getCategorySelect');
	Route::get('sub-category/bycategory', 'CommonController@getSubCategorySelect');
	Route::get('course/bycategoryorsub', 'CommonController@getCoursesSelect');
    Route::get('topics/bycourse', 'CommonController@getTopicByCourseSelect');
	
    Route::get('profile', 'ProfileController@profile');
    Route::put('profile', 'ProfileController@updateProfile');
    Route::post('change-password', 'ProfileController@changePassword');
   // Route::get('tag/list', 'TagController@list');
    Route::get('category/list', 'CategoryController@list');
	Route::get('course/list', 'CourseController@list');
	Route::get('topic/list', 'TopicController@list');
	Route::get('sub-category/list', 'SubCategoryController@list');
    Route::post('product/upload', 'ProductController@upload');
	Route::post('videos/update', 'VideoController@update');
    Route::post('sliders/update', 'SliderController@update');
    Route::post('course/update', 'CourseController@update');
    Route::get('students', 'UserController@students');
    Route::get('tutors', 'UserController@tutors');
    Route::get('settings', 'SettingController@index');
    Route::post('settings', 'SettingController@store');

    Route::apiResources([
        '/user' => 'UserController',
        'product' => 'ProductController',
        'category' => 'CategoryController',
		'questions' => 'QnsAnsController',
        'subcategory' => 'SubCategoryController',
		'course' => 'CourseController',
		'topic' => 'TopicController',
        'page' => 'PageController',
        'videos' => 'VideoController',
        'sliders' => 'SliderController',
        'coupons' => 'CouponController',
    ]);
});

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
	
	Route::middleware(['auth:api'])->group(function () {
		Route::post('change_password', 'RegisterController@changepassword');
		Route::post('profile', 'ProfileController@profile');
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Emadadly\LaravelUuid\Uuids;
use App\Models\Course;
use App\User;

class UserSubscription extends Model
{

    public function course()
    {
        return $this->hasOne(Course::Class, 'id', 'course_id')->withDefault();
    }
	
	public function user()
    {
        return $this->hasOne(User::Class, 'id', 'user_id')->withDefault();
    }
	

}
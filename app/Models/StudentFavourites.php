<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentFavourites extends Model
{
    /**
	* Indicates if the model should be timestamped.
	*
	* @var bool
	*/
	
	public $table = 'student_favourites';
	
    public $timestamps = true;
	
	public function video()
    {
        return $this->hasOne(Video::Class, 'id', 'video_id')->withDefault();
    }
	
	 public function course()
    {
        return $this->hasOne(Course::Class, 'id', 'course_id')->withDefault();
    }
	
}

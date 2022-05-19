<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentFlag extends Model
{
    /**
	* Indicates if the model should be timestamped.
	*
	* @var bool
	*/
	
	public $table = 'student_flag';
	
    public $timestamps = true;
	
	public function tutor()
    {
        return $this->hasOne(Tutor::Class, 'id', 'tutor_id')->withDefault();
    }
	
	
	public function video()
    {
        return $this->hasOne(Video::Class, 'id', 'video_id')->withDefault();
    }
}

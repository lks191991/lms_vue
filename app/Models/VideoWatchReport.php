<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoWatchReport extends Model
{
    protected $fillable = ['course_id', 'user_id', 'video_id', 'duration', 'percent', 'seconds'];
    protected $table = 'video_watch_report';

    public function course()
    {
        return $this->hasOne(Course::Class, 'id', 'course_id')->withDefault();
    }
	
	public function user()
    {
        return $this->hasOne(User::Class, 'id', 'user_id')->withDefault();
    }
}

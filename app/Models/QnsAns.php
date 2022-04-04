<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use SiteHelpers;

class QnsAns extends Model
{

    use Uuids;

    use SoftDeletes;
    protected $table ='qnsans';
    protected $fillable = ['course_id', 'topic_id', 'video_id','question', 'ans1', 'ans2', 'ans3', 'ans4', 'rightans', 'status','user_id'];
    protected $casts = [
        'status' => 'boolean',
    ];
	
    /*
     * Get referenced record of course.
     */
    public function course()
    {
        return $this->belongsTo(Course::Class, 'course_id')->withDefault();
    }

    /*
     * Get referenced record of topic.
     */
    public function topic()
    {
        return $this->belongsTo(Topic::Class, 'topic_id')->withDefault();
    }

    public function video()
    {
        return $this->belongsTo(Video::Class, 'video_id')->withDefault();
    }
    
   
    /*
     * Get referenced record of tutor.
     */
    public function user()
    {
        return $this->belongsTo(User::Class, 'user_id')->withDefault();
    }

    
	
}

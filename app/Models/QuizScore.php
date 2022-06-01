<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use SiteHelpers;

class QuizScore extends Model
{

    //use Uuids;

    //use SoftDeletes;
    protected $table ='quiz_score';
    protected $fillable = ['course_id', 'user_id', 'video_id','quiz_type', 'total_right_ans', 'total_wrong_ans', 'total_qns', 'percent'];
    
    public function course()
    {
        return $this->belongsTo(Course::class,'course_id');
    }
}

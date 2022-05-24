<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use SiteHelpers;

class QuizReport extends Model
{

   // use Uuids;

   // use SoftDeletes;
    protected $table ='quiz_report';
    protected $fillable = ['course_id', 'user_id', 'video_id','quiz_type', 'qnsans_id', 'rightans'];
    
	
    
	
}

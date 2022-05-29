<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Emadadly\LaravelUuid\Uuids;

class Rating extends Model
{

    use Uuids;

    use SoftDeletes;
	
	protected $table = 'ratings';
    protected $dates = ['deleted_at'];
	
	protected $fillable = ['user_id','course_video_id','type','rating','comment','status'];
	protected $casts = [
        'status' => 'boolean',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class,'course_video_id');
    }
	
	
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Emadadly\LaravelUuid\Uuids;

class Topic extends Model
{

    use Uuids;
	
	use SoftDeletes;
	
	 protected $dates = ['deleted_at'];
	protected $fillable = ['name','course_id','description','status'];
	
    public function course()
    {
        return $this->hasOne(Course::Class, 'id', 'course_id')->withDefault();
    }
	
	public function videos()
    {
        $query = $this->hasMany(Video::class, 'course_id');

        return $query;
    }
	
	public function videosTitles() {
     return $this->hasMany(Video::class, 'topic_id')->select(['name', 'topic_id']);
	}
	
	/* public function videos()
    {

        return $this->hasMany(Video::class, 'topic_id');
    } */
	
	
}

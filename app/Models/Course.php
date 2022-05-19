<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Emadadly\LaravelUuid\Uuids;

class Course extends Model
{

    use Uuids;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
	protected $fillable = ['name','category_id','sub_category_id','price','course_type','demo_url','description','status'];
	protected $casts = [
        'status' => 'boolean',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
	
	public function subcategory()
    {
        return $this->belongsTo(SubCategory::class,'sub_category_id');
    }

	public function tutor()
    {
        return $this->belongsTo(User::class,"user_id");
    }
    /*
     * Get all related videos.
     */
    public function videos()
    {
        $query = $this->hasMany(Video::class, 'course_id');

        return $query;
    }

    public function topics()
    {
        $query = $this->hasMany(Topic::class, 'course_id');

        return $query;
    }
	

    public function total_lesson()
    {
        $query = $this->hasMany(Video::class, 'course_id');

        return $query;
    }
	
	public function courseRating()
    {
        $query = $this->hasMany(Rating::class, 'course_video_id')->where('type','=', 'course');

        return $query;
    }
	
	public function videoRating()
    {
        $query = $this->hasMany(Rating::class, 'course_video_id')->where('type','=', 'video');

        return $query;
    }
    
}

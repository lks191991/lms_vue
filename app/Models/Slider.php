<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use SiteHelpers;

class Slider extends Model
{

    use Uuids;

    use SoftDeletes;
    
    
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

    
}

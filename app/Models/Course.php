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
	protected $fillable = ['name','category_id','sub_category_id','price','course_type','demo_url','description','description'];
	
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
	
	public function subcategory()
    {
        return $this->belongsTo(SubCategory::class,'sub_category_id');
    }
    
}

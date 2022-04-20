<?php

namespace App\Http\Controllers\API\F1;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Requests\Products\CategoryRequest;

class CommonController extends BaseController
{
    public function courseListMenu()
    {
        $courses = SubCategory::with('courses')->get();

        return $this->sendResponse($courses, 'courses list');
    }
}
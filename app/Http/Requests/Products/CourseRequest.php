<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('post')) {
            return $this->createRules();
        } elseif ($this->isMethod('put')) {
            return $this->updateRules();
        }
    }
    /**
     * Define validation rules to store method for resource creation
     *
     * @return array
     */
    public function createRules(): array
    {
        return [
            'category_id' => 'required',
			'sub_category_id' => 'required',
			'name' => [
					'required',
					'max:180',
					Rule::unique('courses')->where(function ($query) {  
						return $query->where('sub_category_id', $this->sub_category_id)->whereNull('deleted_at');
					})
				],
            'price' => 'required|numeric',
			'course_type' => 'required',
           'banner_image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    /**
     * Define validation rules to update method for resource update
     *
     * @return array
     */
    public function updateRules(): array
    {
        return [
            'category_id' => 'required',
			'sub_category_id' => 'required',
			'name' => [
					'required',
					'max:180',
					Rule::unique('courses')->where(function ($query) {  
						return $query->where('sub_category_id', $this->sub_category_id)->where('id','<>' ,$this->id)->whereNull('deleted_at');
					})
				],
            'price' => 'required|numeric',
			'course_type' => 'required',
            'banner_image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}

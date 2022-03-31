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
        if (empty($this->id)) {
            return $this->createRules();
        } elseif ($this->id) {
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
			'total_length_minutes' => 'required|numeric',
			'course_type' => 'required',
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
						return $query->where('sub_category_id', $this->sub_category_id)->whereNull('deleted_at')->where('id','<>' ,$this->id);
					})
				],
            'price' => 'required|numeric',
			'total_length_minutes' => 'required|numeric',
			'course_type' => 'required',
        ];
    }
}

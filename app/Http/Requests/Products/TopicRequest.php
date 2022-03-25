<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TopicRequest extends FormRequest
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
            'course_id' => 'required',
			'name' => [
					'required',
					'max:180',
					Rule::unique('topics')->where(function ($query) {  
						return $query->where('course_id', $this->course_id)->whereNull('deleted_at');
					})
				],
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
			'course_id' => 'required',
			'name' => [
					'required',
					'max:180',
					Rule::unique('topics')->where(function ($query) {  
						return $query->where('course_id', $this->course_id)->whereNull('deleted_at')->where('id','<>' ,$this->id);
					})
				],
        ];
    }
}

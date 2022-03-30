<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VideoRequest extends FormRequest
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
			'video_url' => 'required',
            'topic_id' => 'required',
            'tutor_id' => 'required',
            'name' => 'required|max:254',
            'video_url' => 'video_url'
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
			'video_url' => 'required',
            'topic_id' => 'required',
            'tutor_id' => 'required',
            'name' => 'required|max:254',
            'video_url' => 'video_url'
        ];
    }
}

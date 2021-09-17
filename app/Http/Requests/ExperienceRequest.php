<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExperienceRequest extends FormRequest
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
        return [
            "experience_date" => "required|max:255",
            "experience_info" => "required|max:255",
        ];
    }

    public function messages()
    {
        return [
            'experience_date.required' => "Deneyim tarihi girilmesi zorunludur!",
            'experience_date.max' => "Deneyim tarihi alanı için en fazla 255 karakter girebilirsiniz.",
            'experience_info.required' => "Deneyim bilgilerinin girilmesi zorunludur!",
            'experience_info.max' => "Deneyim bilgileri alanı için en fazla 255 karakter girebilirsiniz.",
        ];
    }
}

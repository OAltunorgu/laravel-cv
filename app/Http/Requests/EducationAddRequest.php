<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducationAddRequest extends FormRequest
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
            "education_date" => "required|max:255",
            "education_info" => "required|max:255",
        ];
    }

    public function messages()
    {
        return [
            'education_date.required' => "Eğitim tarihi girilmesi zorunludur!",
            'education_date.max' => "Eğitim tarihi alanı için en fazla 255 karakter girebilirsiniz.",
            'education_info.required' => "Eğitim bilgilerinin girilmesi zorunludur!",
            'education_info.max' => "Eğitim bilgileri alanı için en fazla 255 karakter girebilirsiniz.",
        ];
    }
}

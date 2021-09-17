<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PortfolyoRequest extends FormRequest
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


    public function rules()
    {
        return [
            'title' => 'required|min:2:max:255',
            'tags'  => 'required|min:2:max:255',
            'images.*' => 'mimes:png,jpg,jpeg|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => "Başlık alanı boş geçilmez!",
            'title.min' => "Başlık alanı minimum 2 karakterden oluşmalıdır!",
            'title.max' => "Başlık alanı maksimum 255 karakterden oluşabilir!",
            'tags.required' => "Etiket alanı boş geçilmez!",
            'tags.min' => "Etiket alanı minimum 2 karakterden oluşmalıdır!",
            'tags.max' => "Etiket alanı maksimum 255 karakterden oluşabilir!",
            'images.*.mimes' => "Resimler alanı png,jpg,jpeg olabilir!",
            'images.*.max' => "Resimler maksimum 2MB olabilir!",
        ];
    }
}

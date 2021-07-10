<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerAddRequest extends FormRequest
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
            'title' => 'required|string|min:4',
            'summary' => 'required|min:4',
            'photo' => 'mimes:jpeg,jpg,png|required|max:10000'
        ];
    }
    public function messages(){
        return [
            'required' => ':attribute không được để trống',
            'email' => ':attribute phải đúng định dạng email',
            'min'   => ':attribute phải ít nhất :min ký tự',
            'mimes' => ':attribute phải là jpeg,jpg,png'
        ];
    }

    public function attributes(){
        return [
            'title' => 'Tiêu đề',
            'summary' => 'Tóm tắt',
            'photo' => 'Hình ảnh'
        ];
    }
}

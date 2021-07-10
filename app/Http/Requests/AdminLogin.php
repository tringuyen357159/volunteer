<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminLogin extends FormRequest
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
            'email' => 'required|email|min:6',
            'password' => 'required|min:6',
        ];
    }
    public function messages(){
        return [
            'required' => ':attribute không được để trống',
            'email' => ':attribute phải đúng định dạng email',
            'min'   => ':attribute phải ít nhất :min ký tự',
        ];
    }

    public function attributes(){
        return [
            'email' => 'Email',
            'password' => 'Mật khẩu',
        ];
    }
    
}

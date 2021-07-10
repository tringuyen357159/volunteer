<?php

namespace App\Http\Requests\client;

use Illuminate\Foundation\Http\FormRequest;

class VolunteerLoginRequest extends FormRequest
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
            'email'=>'required|email|string',
            'password'=>'required|string|min:6',
        ];
    }
    public function messages(){
        return [
            'required' => ':attribute không được để trống',
            'email' => ':attribute phải đúng định dạng email',
            'min'   => ':attribute phải ít nhất 6 ký tự',
        ];
    }

    public function attributes(){
        return [
            'email' => 'Email',
            'password' => 'Mật khẩu'
        ];
    }

}

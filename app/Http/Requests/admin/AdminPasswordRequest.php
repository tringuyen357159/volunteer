<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminPasswordRequest extends FormRequest
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
            'password_old'=>'required',
            'password'=>'required|string|min:6',
            'password_confirm'=>'required|same:password'
        ];
    }

    public function messages(){
        return [
            'required' => ':attribute không được để trống',
            'same' => ':attribute không chính xác',
            'min' => ':attribute phải có ít nhất 6 ký tự',
        ];
    }
    public function attributes(){
        return [
            'password_old' => 'Mật khẩu cũ',
            'password' => 'Mật khẩu mới',
            'password_confirm' => 'Xác nhận mật khẩu',

        ];
    }
}

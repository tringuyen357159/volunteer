<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAddRequest extends FormRequest
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
            'email' => 'required|email|unique:users',
            'name' => 'required|string|max:50',
            'phone' => 'required|regex:/^0[0-9]{9}$/|string|max:10',
            // 'phone' => 'required|regex:/(01)[0-9]{9}/',
            'address' => 'required|string|max:100',
            'gender' => 'required',
            'photo' => 'mimes:jpeg,jpg,png|required|max:10000',
            'password' => 'required',
            'roles' => 'required',
        ];
    }
    public function messages(){
        return [
            'required' => ':attribute không được để trống',
            'email' => ':attribute phải đúng định dạng email',
            'unique' => ':attribute đã tồn tại',
            'min'   => ':attribute phải ít nhất :min ký tự',
            'regex' => ':attribute không đúng định dạng'
        ];
    }

    public function attributes(){
        return [
            'name' => 'Tên',
            'roles' => 'Quyền',
            'gender' => 'Giới tính',
            'phone' => 'Số điện thoại',
            'email' => 'Email',
            'address' => 'Địa chỉ',
            'password' => 'Mật khẩu',
            'photo' =>'Hình ảnh'
        ];
    }

}

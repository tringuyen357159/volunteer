<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'name'=>'required|string',
            // 'photo'=>'mimes:jpeg,jpg,png|max:1000',
            'gender'=>'required|in:male,female',
            // 'email'=>'required|email|string|unique:users,email,' . $this->id,
            'phone'=>'required|regex:/^0[0-9]{9}$/|min:10|max:10',
            'address'=>'required|string',
            'birthday'=>'required|before:today',
        ];
    }

    public function messages(){
        return [
            'required' => ':attribute không được để trống',
            'email' => ':attribute phải đúng định dạng email',
            'min'   => ':attribute phải ít nhất 10 ký tự',
            'max'   => ':attribute tối đa 10 ký tự',
            'date_format'=>':attribute không đúng định dạng ngày d/m/Y',
            'before'=>':attribute phải sau hôm nay',
            'regex' => ':attribute định dạng không đúng'
        ];
    }
    public function attributes(){
        return [
            'name' => 'Tên',
            'gender' => 'Giới tính',
            'phone' => 'Số điện thoại',
            'address' => 'Địa chỉ',
            'birthday' => 'Ngày sinh ',
        ];
    }
}

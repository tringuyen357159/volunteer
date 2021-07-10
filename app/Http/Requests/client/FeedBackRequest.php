<?php

namespace App\Http\Requests\client;

use Illuminate\Foundation\Http\FormRequest;

class FeedBackRequest extends FormRequest
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
            'email'=>'required|email|string',
            'phone'=>'required|regex:/^0[0-9]{9}$/|min:10|max:10',
            'address'=>'required|string',
            'topic'=>'required|string',
            'content'=>'required|string',
        ];
    }
    public function messages(){
        return [
            'required' => ':attribute không được để trống',
            'email' => ':attribute phải đúng định dạng email',
        ];
    }
    public function attributes(){
        return [
            'name' => 'Tên',
            'phone' => 'Số điện thoại',
            'address' => 'Địa chỉ',
            'email' => 'Email',
            'topic' => 'Chủ đề',
            'content' => 'Chi tiết',
        ];
    }
}

<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class SponsorStoreRequest extends FormRequest
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
            'email'=>'required|email|string|unique:sponsors,email,' . $this->id,
            'phone'=>'required|regex:/^0[0-9]{9}$/|min:10|max:10',
            'address'=>'required|string',
            'amount_financed'=>'required|numeric',
        ];
    }
    public function messages(){
        return [
            'required' => ':attribute không được để trống',
            'email' => ':attribute phải đúng định dạng email',
            'numeric'=>':attribute phải là số ',
            'unique'=>':attribute phải là duy nhất '
        ];
    }
    public function attributes(){
        return [
            'name' => 'Tên nhà tài trợ',
            'email' => 'Email',
            'phone' => 'Số điện thoại',
            'address' => 'Địa chỉ',
            'amount_financed' => 'Số tiền tài trợ',

        ];
    }
}

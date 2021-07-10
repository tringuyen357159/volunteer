<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleAdd extends FormRequest
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
            'name' => 'required|max:50|min:5',
            'display_name' => 'required|max:50|min:5',
            'permission' => 'required',
        ];
    }
    public function messages(){
        return [
            'required' => ':attribute không được để trống',
            'max' => ':attribute không được quá :max ký tự',
            'min'   => ':attribute phải ít nhất :min ký tự',
        ];
    }

    public function attributes(){
        return [
            'name' => 'Tên',
            'display_name' => 'Hiển thị',
            'permission' => 'Chức năng',
        ];
    }
}

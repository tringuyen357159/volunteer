<?php

namespace App\Http\Requests\client;

use Illuminate\Foundation\Http\FormRequest;

class VolunteerPasswordRequest extends FormRequest
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
            'same' => ':attribute xác nhận không chính xác',
            'min' => ':attribute ít nhất 6 ký tự',
        ];
    }
}

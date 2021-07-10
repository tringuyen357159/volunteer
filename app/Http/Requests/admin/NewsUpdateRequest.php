<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class NewsUpdateRequest extends FormRequest
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
            'title'=>'required|string|max:255',
            'poster'=>'required|string|max:30',
            'summary'=>'required|string',
            'content'=>'required|string',
            'photo'=>'mimes:jpeg,jpg,png',
        ];
    }
        public function messages(){
            return [
                'required' => ':attribute không được để trống',
                'max' => ':attribute không được quá :max ký tự',
                ];
        }

        public function attributes(){
            return [
                'title' => 'Tiêu đề',
                'poster' => 'Người đăng',
                'summary' => 'Tóm tắt',
                'content' => 'Nội dung',
                'photo' => 'Hình ảnh',

            ];
        }
}



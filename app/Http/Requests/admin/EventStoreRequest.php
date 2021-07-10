<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class EventStoreRequest extends FormRequest
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
        $day= Carbon::now('Asia/Ho_Chi_Minh');

        $two_weeks_from_now = $day->addWeeks(2);
        return [
            'title'=>'required|string',
            'summary'=>'required|string',
            'content'=>'required|string',
            'photo'=>'required|mimes:jpeg,jpg,png|max:1000',
            'budget_estimates'=>'required|numeric',
            'number_of_participants'=>'required|numeric',
            'start_day'=>'required|date_format:m/d/Y H:i:s|after:'.$two_weeks_from_now,
            'end_day'=>'required|date_format:m/d/Y H:i:s|after:start_day',
            'type'=>'required|string',
            'location'=>'required|string',
        ];
    }
    public function messages(){
        return [
            'required' => ':attribute không được để trống',
            'numeric' => ':attribute phải là số',
            'date_format'=>':attribute không đúng định dạng ngày m/d/y H:i:s',
            'after:$two_weeks_from_now' =>':attribute phải sau 15 ngày kể từ bây giờ'
        ];
    }
    public function attributes(){
        return [
            'title' => 'Tiêu đề',
            'summary' => 'Tóm lược',
            'content' => 'Nội dung',
            'photo' => 'Ảnh',
            'budget_estimates' => 'Chi phí dự trù',
            'number_of_participants' => 'Số người tham gia',
            'start_day' => 'Ngày bắt đầu',
            'end_day' => 'Ngày kết thúc',
            'type' => 'Loại sự kiện',
            'location' => 'Địa điểm',
        ];
    }
}

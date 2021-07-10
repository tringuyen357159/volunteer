<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Feedback;
use App\Http\Requests\client\FeedBackRequest;
class FeedbackController extends Controller
{
    public function index()
    {
         return view('main.pages.contact');
    }
    public function store(FeedBackRequest $request)
    {
        $data = $request->all();
        $status = Feedback::create($data);
        if ($status) {
            toastr()->success('Đã gửi phản hồi', 'Thông báo', ["positionClass" => "toast-top-right", 'timeOut' => 1000]);
        } else {
            toastr()->error('Phản hồi thất bại!');
            return redirect()->back();
        }
        return redirect()->route('home');

    }
}

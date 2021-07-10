<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Feedback;
class FeedbackController extends Controller
{
    public function index()
    {
        $feedback = Feedback::orderBy('id', 'DESC')->get();

        return view('admin.pages.feedback.list')->with('feedback', $feedback);
    }
    public function delete($id)
    {
        $feedback = Feedback::find($id);
        $status = $feedback->delete();
        if ($status) {
            toastr()->warning('Xoá phản hồi thành công!', 'Thông báo', ['timeOut' => 2000]);
        } else {
            toastr()->error('Lỗi!');
        }
        return redirect()->route('feedback.show');
    }
}

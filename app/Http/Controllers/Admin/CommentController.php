<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function list()
    {

        $comments = DB::table('comments')
            ->select('users.name', 'event.title', 'comments.*')
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->join('event', 'event.id', '=', 'comments.event_id')
            ->where('deleted_at', '=', null)
            ->orderBy('comments.id','desc')
            ->get();
        // dd($comments);
        return view('admin.pages.comment.index', compact('comments'));
    }

    public function delete($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        toastr()->success('Xoá thành công!', 'Thông báo', ['timeOut' => 2000]);
        return redirect()->route('comment.list');
    }
}

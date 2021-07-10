<?php

namespace App\Http\Controllers\Client;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\AllNotification;
use App\User;
use Illuminate\Support\Facades\Notification;

class CommentController extends Controller
{
    public function store(Request $request)
    {
    	$request->validate([
            'body'=>'required',
        ]);

        $data = $request->all();

        $user = User::query()
        ->where('email', session()->get('user'))
        ->first();

        $data['user_id']= $user->id;
        $comment = Comment::create($data);

        return back();
    }

}

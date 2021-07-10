<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // select all users except logged in user
        // $users = User::where('id', '!=', Auth::id())->get();

        // count how many message are unread from the selected user
        $admin = DB::table('admin')
            ->join('users', 'users.id', '=', 'admin.user_id')
            ->select('admin.*')->get();

        $employees = DB::table('employees')
            ->join('users', 'users.id', '=', 'employees.user_id')
            ->select('employees.*')->get();

        // $all=DB::table('users')
        // ->select('users.*')
        $users = DB::table('users')
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->fromRaw('volunteers,sponsors')
                    ->whereRaw('volunteers.user_id = users.id and sponsors.user_id != users.id');
            })
            ->leftJoin('messages', function ($join) {
                $join->on('users.id', '=', 'messages.from')
                    ->where('is_read', 0)
                    ->where('messages.to', '=', Auth::id());;
            })
            ->where('users.id', '!=', Auth::id())
            ->groupBy('users.id', 'users.name', 'users.photo', 'users.email')
            ->select('users.id', 'users.name', 'users.photo', 'users.email', DB::raw('COUNT(is_read) as unread'))
            ->get();


        // $users = DB::select("select users.id, users.name, users.photo, users.email, count(is_read) as unread
        // from users
        // LEFT  JOIN  messages ON users.id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
        // where users.id != " . Auth::id() . "
        // group by users.id, users.name, users.photo, users.email");
        dd($users);
        return view('admin.pages.chat.index', ['users' => $users]);
    }

    public function getMessage($user_id)
    {
        $my_id = Auth::id();

        // Make read all unread message
        Message::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);

        // Get all message from selected user
        $messages = Message::where(function ($query) use ($user_id, $my_id) {
            $query->where('from', $user_id)->where('to', $my_id);
        })->oRwhere(function ($query) use ($user_id, $my_id) {
            $query->where('from', $my_id)->where('to', $user_id);
        })->get();

        return view('admin.pages.chat.message', ['messages' => $messages]);
    }

    public function sendMessage(Request $request)
    {
        $from = Auth::id();
        $to = $request->receiver_id;
        $message = $request->message;

        $data = new Message();
        $data->from = $from;
        $data->to = $to;
        $data->message = $message;
        $data->is_read = 0; // message will be unread when sending message
        $data->save();

        // pusher
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data = ['from' => $from, 'to' => $to]; // sending from and to user id when pressed enter
        $pusher->trigger('my-channel', 'my-event', $data);
    }
}

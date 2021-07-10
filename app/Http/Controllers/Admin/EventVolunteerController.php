<?php

namespace App\Http\Controllers\Admin;

use App\event_volunteer;
use App\Http\Controllers\Controller;
use App\tool_volunteer;
use App\Volunteer;

class EventVolunteerController extends Controller
{
    public function index()
    {
        $eventVolunteer = event_volunteer::with('user')->get();
        foreach ($eventVolunteer as $key => $value) {
            $volunteer = Volunteer::where('user_id', $value->user->id)->first();
            $value->phone = $volunteer->phone;
            $value->birthday = $volunteer->birthday;
            $value->address = $volunteer->address;
            $value->toolVolunteer = tool_volunteer::where('event_id', $value->event->id)->where('user_id', '=', $value->user_id)->get(); //lấy cái cuối
        }
        return view('admin.pages.export.exporteventvolunteer')
            ->with('eventVolunteer', $eventVolunteer);
    }
}

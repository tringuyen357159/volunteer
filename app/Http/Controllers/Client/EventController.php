<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;
use App\User;
use App\event_volunteer;
use App\event_tool;
use Carbon\Carbon;
use App\tool_volunteer;
use App\Tools;



class EventController extends Controller
{
    public function ListEvent()
    {
        $events = Event::orderBy('id', 'DESC')
        ->where('status', Event::STATUS_TRUE)
        ->paginate(3);
        $events_mt = Event::orderBy('id', 'DESC')
        ->where('status', Event::STATUS_TRUE)
        ->where('type', 'môi trường')
        ->take(3)
        ->get();
        $events_tt = Event::orderBy('id', 'DESC')
        ->where('status', Event::STATUS_TRUE)
        ->where('type', 'thể thao')
        ->take(3)
        ->get();
        $events_qt = Event::orderBy('id', 'DESC')
        ->where('status', Event::STATUS_TRUE)
        ->where('type', 'quyên tặng')
        ->take(3)
        ->get();
        return view('main.pages.event.ListEvent')->with('events', $events)
                ->with('events_mt', $events_mt)
                ->with('events_tt', $events_tt)
                ->with('events_qt', $events_qt);
    }

    public function DetailEvent($slug)
    {
        $event_detail = Event::where('slug', $slug)->first();
        $event_random = Event::whereNotIn('slug', [$slug])->take(6)->get();
        $event_tool = event_tool::query()
            ->where('event_id', $event_detail->id)
            ->get();
        $day = Carbon::now('Asia/Ho_Chi_Minh');
        return view('main.pages.event.DetailEvent')
            ->with('event_detail', $event_detail)
            ->with('event_tool', $event_tool)
            ->with('event_random', $event_random)
            ->with('day',$day);
    }

    public function RegisterEvent(Request $request)
    {
        $id=$request->event_id;
        $tools = [];
        if ($request->tool) {
            foreach ($request->tool as $key => $tool) {
                if (isset($tool['isCheck']) && $tool['quanlity']) {
                    $tools[$key]= $tool;
                }
                else if(isset($tool['isCheck']) && !$tool['quanlity']){
                    toastr()->error('Vui lòng nhập số lượng hoặc số lượng đã đủ');
                    return redirect()->back();
                }
            }
        }
        $event_detail= Event::find($id);
        $user = User::query()
        ->where('email', session()->get('user'))
        ->first();
        $eventVolunteers = $user->eventVolunteer;
        $dem=0;$trung=0;
        $day= Carbon::now('Asia/Ho_Chi_Minh');
        $today =  date('Y-m-d h:i:s', strtotime($day));
        foreach ($eventVolunteers as $eventVolunteer) {
            $formatEndDay =  $eventVolunteer->event->end_day;
            $formatStartDay = $eventVolunteer->event->start_day;
            if (($event_detail->start_day > $formatStartDay && $event_detail->start_day < $formatEndDay) ||
                ($event_detail->end_day > $formatStartDay && $event_detail->end_day < $formatEndDay) ||
                ($event_detail->start_day < $formatStartDay && $event_detail->end_day > $formatEndDay) ||
                ($event_detail->start_day > $formatEndDay && (strtotime($event_detail->start_day)- strtotime($formatEndDay)) < 86400)
                )
            {
                $dem++;
            }
            if($eventVolunteer->event_id==$id)
            {
                $trung++;
            }
        }
        if(strtotime($event_detail->start_day) - strtotime($day) < 43160){
            toastr()->error('Sự kiện sắp tổ chức bạn không thể đăng ký');
            return redirect()->back();
        }
        else if( $event_detail->start_day < $today){
            toastr()->error('Sự kiện này đã diễn ra rồi');
            return redirect()->back();
        }
        else if($dem > 0){
            toastr()->error('Sự kiện đã bị trùng ngày');
            return redirect()->back();
        }
        else if($trung > 0){
            toastr()->error('Sự kiện đã đăng ký rồi');
            return redirect()->back();
        }
        else if($event_detail->real_quantity == $event_detail->number_of_participants){
            toastr()->error('Sự kiện đã đủ người tham gia');
            return redirect()->back();
        }
        else{
            $data['user_id']= $user->id;
            $data['event_id']= $event_detail->id;
            $data['user_name']= $user->name;
            $data['event_name']= $event_detail->title;
            $status = event_volunteer::create($data);
            if($status && $tools){
                foreach ($tools as $key => $tool) {
                    $eventTool = Tools::find($key);
                    $data['name_volunteer'] = $user->name;
                    $data['name_tool'] = $eventTool->name;
                    $data['quanlity'] = $tool['quanlity'];
                    $data['user_id'] =  $user->id;
                    $data['tool_id'] = $key;
                    $data['event_id']= $event_detail->id;
                    $statu = tool_volunteer::create($data);
                    if (!$statu) {
                        toastr()->error('failed!');
                        return back();
                    }
                }
            }
            foreach ($tools as $key => $tool) {
                $eventTool = event_tool::where('tool_id',$key)
                ->where('event_id',$id)
                ->first();
                $eventTool->update(['real_quanlity' => $eventTool->real_quanlity + $tool['quanlity']]);
            }
            $event_detail->update(['real_quantity' => $event_detail->real_quantity + 1]);
            toastr()->success('Đăng ký sự kiện thành công!', 'Thông báo', ["positionClass" => "toast-top-right",'timeOut' => 5000]);
            return redirect()->route('client.eventmanagement');
        }
    }
}

<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sponsor;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DonateController extends Controller
{
    public function index()
    {
        // $month = Carbon::now()->month();
        $month = Carbon::now()->month;
        $sponsors = DB::table('sponsors')
            ->whereMonth('created_at', now()->month)
            ->get();
        // $date = strtotime($sponsors->created_at);
        // $month = date('m', $date);

        $detail_spending = DB::table('detail_spending')
            ->join('event', 'event.id', '=', 'detail_spending.event_id')
            ->join('sponsors', 'sponsors.id', '=', 'detail_spending.sponsor_id')
            ->select('event.title', 'detail_spending.*', 'sponsors.name')
            ->get();

        $sponsormore = Sponsor::all()->count();
        $fund = DB::table('sponsors')
            ->sum('sponsors.amount_financed');
        return view('main.pages.donate', compact('sponsors', 'detail_spending', 'sponsormore', 'fund', 'month'));
    }
}

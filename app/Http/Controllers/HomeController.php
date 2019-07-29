<?php

namespace App\Http\Controllers;

use App\Days;
use App\Arrival;
use App\Departure;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $day_id = Days::where('day', Carbon::now()->isoFormat('dddd'))->pluck('id')->first();
        
        $second_day_id = $day_id != 7 ? ($day_id + 1) : ($second_day_id = 1);
        
        $arivals = Arrival::whereHas('days', function($q) use ($day_id,$second_day_id){
                $q->where('days_id',$day_id)
                ->orWhere('days_id',$second_day_id);
                })->where('time', '>=', Carbon::now('Europe/Zagreb'))
                ->where('status', '!=', '3')
                ->orderBy('time')
                ->take(12)
                ->get();

        $departures = Departure::whereHas('days', function($q) use ($day_id,$second_day_id){
            $q->where('days_id',$day_id)
            ->orWhere('days_id',$second_day_id);
            })->where('time', '>=', Carbon::now('Europe/Zagreb'))
            ->where('status', '!=', '3')
            ->orderBy('time')
            ->take(12)
            ->get();

        return view('home', compact('arivals', 'departures'));
    }
}

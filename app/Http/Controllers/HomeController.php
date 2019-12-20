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
 
        $arivals = Arrival::whereHas('days', function($q) use ($day_id){
            $q->where('days_id',$day_id);
            })->where('time', '>=', Carbon::now('Europe/Zagreb')->addMinutes(-5))
            ->where('activity', '=', '1')
            ->orderBy('time')
            ->take(12)
            ->get();

        $arivals_delayed = Arrival::where('status', 1)->get();
        $arivals = $arivals->merge($arivals_delayed);


            if(Carbon::now('Europe/Zagreb')->format('H:i:s') > '23:00:00' && Carbon::now('Europe/Zagreb')->format('H:i:s') < '24:00:00'){
                $arivals_tommorow = Arrival::whereHas('days', function($q) use ($second_day_id){
                $q->where('days_id',$second_day_id);
                })->where('time', '<', '01:00:00')
                ->where('status', '!=', '3')
                ->where('activity', '=', '1')
                ->orderBy('time')
                ->take(12)
                ->get();

                $arivals = $arivals->merge($arivals_tommorow);
            }


        $departures = Departure::whereHas('days', function($q) use ($day_id){
            $q->where('days_id',$day_id);
            })->where('time', '>=', Carbon::now('Europe/Zagreb')->addMinutes(-5))
            ->where('activity', '=', '1')
            ->orderBy('time')
            ->take(12)
            ->get();
        
        $departures_delayed = Departure::where('status', 1)->get();
        $departures = $departures->merge($departures_delayed);

        if(Carbon::now('Europe/Zagreb')->format('H:i:s') > '23:00:00' && Carbon::now('Europe/Zagreb')->format('H:i:s') < '24:00:00'){
            $departures_tommorow = Departure::whereHas('days', function($q) use ($second_day_id){
                $q->where('days_id',$second_day_id);
                })->where('time', '<', '01:00:00')
                ->where('status', '!=', '3')
                ->where('activity', '=', '1')
                ->orderBy('time')
                ->take(12)
                ->get();

                $departures = $departures->merge($departures_tommorow);
            }

         foreach($arivals as $arival){
             if($arival->time < Carbon::now('Europe/Zagreb')->format('H:i:s') && $arival->status == 0){
                 $arival->status = 1;
                 $arival->save();
             }
         }

         foreach($departures as $departure){
             if($departure->time < Carbon::now('Europe/Zagreb')->format('H:i:s') && $departure->status == 0){
                 $departure->status = 1;
                 $departure->save();
             }
         }

         $departures = $departures->sortBy('time');
         $arivals = $arivals->sortBy('time');

        return view('home', compact('arivals', 'departures'));
    }
}

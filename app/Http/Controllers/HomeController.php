<?php

namespace App\Http\Controllers;

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

        
        $arivals = Arrival::where('time', '>=', Carbon::now('Europe/Zagreb'))->where('status', '!=', '3')->orderBy('time')->take(12)->get();
        $departures = Departure::where('time', '>=', Carbon::now('Europe/Zagreb'))->orderBy('time')->take(12)->get();

        return view('home', compact('arivals', 'departures'));
    }


}

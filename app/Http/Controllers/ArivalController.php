<?php

namespace App\Http\Controllers;

use App\Days;
use App\Arrival;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\TransferRequest;

class ArivalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Arrival::with('days')->orderBy('time')->get();
    }

    public function bakula()
    {
        $day_id = Days::where('day', Carbon::now()->isoFormat('dddd'))->pluck('id')->first();
        $second_day_id = $day_id != 7 ? ($day_id + 1) : ($second_day_id = 1);
                
        $arivals = Arrival::with('days')->whereHas('days', function($q) use ($day_id){
            $q->where('days_id',$day_id);
            })->where('time', '>=', Carbon::now('Europe/Zagreb')->addMinutes(-5))
            ->orWhere('status', '!=', 2)
            ->where('activity', '=', '1')
            ->orderBy('time')
            ->take(12)
            ->get();

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
        
        
            foreach($arivals as $arival){
                $arival->time = \Carbon\Carbon::parse($arival->time)->format('H:i');
            }
            return $arivals;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransferRequest $request)
    {


        $data = $request->except('days');

        $data['time'] = Carbon::parse($request->time)->timezone('Europe/Zagreb')->format('H:i');

        $days = Days::findOrFail($request->days);

        $arrival = Arrival::create($data);

        $arrival->days()->attach($days);

        return "Ruta kreirana";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Arrival $arrival, Request $request)
    {
        $request->status !== null ? $arrival->update(['status' => $request->status]) : '';
        $request->activity !== null ? $arrival->update(['activity' => $request->activity]) : '';
        return "promjenjeno";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Arrival::where('id', $id)->delete();
        return "promjenjeno";
    }
}
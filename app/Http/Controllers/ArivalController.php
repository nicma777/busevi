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
                
        return Arrival::whereHas('days', function($q) use ($day_id){
            $q->where('days_id',$day_id);
            })->where('time', '>=', Carbon::now('Europe/Zagreb'))
            ->where('status', '!=', '3')
            ->orderBy('time')
            ->take(12)
            ->get();
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
        $arrival->update(['status' => $request->status]);
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

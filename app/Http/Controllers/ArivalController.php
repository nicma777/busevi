<?php

namespace App\Http\Controllers;

use App\Days;
use App\Arrival;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ArivalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Arrival::where('time', '>=', Carbon::now('Europe/Zagreb')->addHour(-1))->orderBy('time')->take(50)->get();
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
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'city' => 'required|max:255',
            'carrier' => 'required',
            'status' => 'required',
            'time' => 'required',
            'days' => 'required',
        ]);


        $data = $validatedData->except('days');

        $data['time'] = Carbon::parse($validatedData->time)->timezone('Europe/Zagreb')->format('H:i');

        $days = Days::findOrFail($validatedData->days);

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
        return view('dashboard');
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
        return view('dashboard');
    }
}

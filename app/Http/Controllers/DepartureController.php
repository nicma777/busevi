<?php

namespace App\Http\Controllers;

use App\Days;
use App\Arrival;
use App\Departure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\TransferRequest;

class DepartureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Departure::with('days')->orderBy('time')->get();
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

        $departure = Departure::create($data);

        $departure->days()->attach($days);

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
    public function update(Departure $departure, Request $request)
    {
        $departure->update(['status' => $request->status]);
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
        Departure::where('id', $id)->delete();
        return "promjenjeno";
    }
}

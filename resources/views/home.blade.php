@extends('layouts.tv')

@section('content')

<div class="row header p-2 pr-2">
    <div class="col-md-8">
        <img src="{{ asset("autobusni-kolodvor-sibenik.png") }}" alt="" style="width: 60%">
    </div>
    <div class="col-md-4 pr-2 second clock text-center">
        {{ \Carbon\Carbon::now()->format('d.m.Y. H:i') }}
    </div>
</div>

<div class="row second mb-0">
    <div class="col col-md-6  text-center text-white column-head">
        DOLASCI &nbsp;&nbsp;<span class="text-second">ARIVALS</span>
    </div>
    <div class="col col-md-6 text-center text-white column-head">
        POLASCI &nbsp;&nbsp;<span class="text-second">DEPARTURES</span>
    </div>
</div>

<div class="row mt-0 pt-0 fill-height-or-more">
    <div class="col col-md-6 p-0 ">
        <table class="table table-zebra table-borderless ">
            <thead>
                <tr>
                    <th>
                        <strong class="text-white header">Autobusna linija</strong>
                        <br>
                        <span class="text-second header">Bus line</span>
                    </th>
                    <th>
                        <strong class="text-white header ">Prijevoznik </strong>
                        <br>
                        <span class="text-second header">Carrier</span>
                    </th>
                    <th>
                        <strong class="text-white header">Dolazak </strong>
                        <br>
                        <span class="text-second header">Arival</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($arivals as $arival)
                <tr>
                    <td>{{ $arival->city }}</td>
                    <td>{{ $arival->carrier }}</td>
                    <td>
                        @if($arival->status == '1')
                        <span class="text-danger delay">DELAY</span>
                        @elseif($arival->status == '2')
                        <span class="text-success ongate">ARRIVED</span>
                        @elseif($arival->status == '3')
                        <span class="text-info">LEAVE</span>
                        @else
                        <span>{{ \Carbon\Carbon::parse($arival->time)->format('H:i') }}</span>
                        @endif
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col col-md-6  p-0">
        <table class="table table-zebra table-borderless">
            <thead>
                <tr>
                    <th>
                        <strong class="text-white header">Autobusna linija</strong>
                        <br>
                        <span class="text-second header">Bus line</span>
                    </th>
                    <th>
                        <strong class="text-white header">Prijevoznik </strong>
                        <br>
                        <span class="text-second header">Carrier</span>
                    </th>
                    <th>
                        <strong class="text-white header">Polazak </strong>
                        <br>
                        <span class="text-second header">Departure</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($departures as $departure)
                <tr>
                    <td>{{ $departure->city }}</td>
                    <td>{{ $departure->carrier }}</td>
                    <td>
                        @if($departure->status == '1')
                        <span class="text-danger delay">DELAY</span>
                        @elseif($departure->status == '2')
                        <span class="text-success ongate">DEPARTED</span>
                        @elseif($departure->status == '3')
                        <span class="text-info">ON GATE</span>
                        @else
                        <span>{{ \Carbon\Carbon::parse($departure->time)->format('H:i') }}</span>
                        @endif
                    </td>

                </tr>
                @endforeach

            </tbody>
        </table>

    </div>


</div>

@endsection
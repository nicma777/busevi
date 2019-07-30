@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Unos ruta</div>
                <div class="card-body">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-arrivals"
                                role="tab" aria-controls="pills-home" aria-selected="true">Dolasci</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-departures"
                                role="tab" aria-controls="pills-profile" aria-selected="false">Polasci</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-arrivals" role="tabpanel"
                            aria-labelledby="pills-home-tab">

                            @if(Auth::user()->role == 'admin')
                            <transfers type="arrival"></transfers>
                            @else
                            <bakula type="arrival"></bakula>
                            @endif

                        </div>


                        <div class="tab-pane fade" id="pills-departures" role="tabpanel"
                            aria-labelledby="pills-profile-tab">

                            @if(Auth::user()->role == 'admin')
                            <transfers type="departure"></transfers>
                            @else
                            <bakula type="departure"></bakula>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
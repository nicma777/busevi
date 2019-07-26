<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Days extends Model
{
    protected $guarded = [];

    public function arrival()
    {
        return $this->belongsToMany('App\Arrival', 'arrival_day');
    }

    public function departure()
    {
        return $this->belongsToMany('App\Departure', 'departure_day');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departure extends Model
{
    protected $guarded = ['id'];
    protected $dates = ['datetime'];

    public function days()
    {
        return $this->belongsToMany('App\Days', 'departure_day');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arrival extends Model
{
    protected $guarded = ['id'];
    protected $dates = ['datetime'];

    public function days()
    {
        return $this->belongsToMany('App\Days', 'arrival_day');
    }
}

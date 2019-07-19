<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departure extends Model
{
    protected $guarded = ['id'];
    protected $dates = ['datetime'];


}

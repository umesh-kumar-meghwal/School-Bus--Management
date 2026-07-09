<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Stop extends Model
{
    protected $table = "stop";
    public $timestamps =false;
    protected $fillable = [
        'stop_name',
        'route_id',
        'route_name',
        'pickup_time',
        'drop_time',
        'latitude',
        'longitude',
        'school_email',
    ];
}
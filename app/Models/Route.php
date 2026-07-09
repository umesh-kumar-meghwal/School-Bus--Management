<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Route extends Model
{
    protected $table = "route";
    public $timestamps = false;
    protected $fillable = [
        'route_name',
        'start_point',
        'start_time',
        'end_point',
        'end_time',
        'distance',
        'estimated_time',
        'status',
        'school_email'
    ];
}
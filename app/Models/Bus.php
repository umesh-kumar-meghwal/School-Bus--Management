<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Bus extends Model
{
     protected $table = "bus";
    public $timestamps = true;
    protected $fillable = [
        'bus_number',
        'bus_name',
        'driver_name',
        'driver_phone',
        'route_name',
        'total_seats',
        'available_seats',
        'status',
        'latitude',
        'longitude'
     ];
}
<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    protected $table = "feest";
    public $timestamps =false;
    protected $fillable = [
        'stop_name',
        'fee'
    ];
   
}


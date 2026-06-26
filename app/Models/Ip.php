<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Ip extends Model
{
    protected $table = "ip";
    public $timestamps = false;
    protected $fillable = [
        'ip'
    ];
}

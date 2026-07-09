<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $table = 'driver';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'license_number',
        'school_email',

    ];
}
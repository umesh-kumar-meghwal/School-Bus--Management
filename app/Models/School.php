<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $table = 'school';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'shool_name',
        'school_email',
        'phone',
        'address'
    ];
}

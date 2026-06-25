<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student_Fee extends Model
{
    protected $table = 'student_fee';
    public $timestamps = false;
    protected $fillable = [
        'st_email',
        'stop_name',
        'total_fee',
        'deposit_fee',
        'due_fee',
        'date',
        'time'
    ];
}

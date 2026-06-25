<?php 

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = "student";
    public $timestamps = false;
    protected $fillable = [
        'name',
        'father_name',
        'mother_name',
        'mobile',
        'guardians_mobile',
        'depart_name',
        'email',
        'address',
        'photo'
     ];
}
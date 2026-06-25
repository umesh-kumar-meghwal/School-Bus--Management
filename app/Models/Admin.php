<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = "admin";
    public $timestamps =false;
    protected $fillable = [
        'name',
        'email',
        'contact',
        'address',
        'password'
    ];
   
}


class Login extends Model
{
    protected $table ="login";
    public $timestamps =false;

     protected $fillable = [
        'email',
        'password',
        'usertype'
    ];

}

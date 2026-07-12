<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class App_updates extends Model
{
    protected $table = "app_updates";
    public $timestamps = true;
    protected $fillable = [
        'latest_version',
        'apk_path',
        'is_force'
    ];
}

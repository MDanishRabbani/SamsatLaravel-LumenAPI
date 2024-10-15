<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Samsat extends Model
{
    protected $table = 'samsat';

    protected $fillable = ['name', 'latitude', 'longitude', 'city'];

    public $timestamps = false; 
}

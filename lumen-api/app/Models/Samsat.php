<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Samsat extends Model
{
    protected $table = 'samsat';

    protected $fillable = ['name', 'address', 'latitude', 'longitude', 'city'];

    public $timestamps = false; 
}

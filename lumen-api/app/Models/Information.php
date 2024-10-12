<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $table = 'information';

    protected $fillable = ['image_url', 'title', 'description', 'date'];

    // Nonaktifkan timestamps
    public $timestamps = false; // Menonaktifkan created_at dan updated_at
}

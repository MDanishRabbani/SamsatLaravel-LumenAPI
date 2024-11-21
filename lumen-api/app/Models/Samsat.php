<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Samsat extends Model
{
    protected $table = 'samsat';

    protected $fillable = ['name', 'address', 'latitude', 'longitude', 'city', 'type', 'is_active'];

    public $timestamps = false;

    // Define relationship with schedules
    public function schedules(): HasMany {
        return $this->hasMany(SamsatSchedule::class);
    }
}

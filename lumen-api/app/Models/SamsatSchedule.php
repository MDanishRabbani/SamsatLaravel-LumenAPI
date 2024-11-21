<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SamsatSchedule extends Model
{
    protected $table = 'samsat_schedules';

    protected $fillable = ['samsat_id', 'day', 'address', 'latitude', 'longitude'];

    public $timestamps = false;

    public function samsat() {
        return $this->belongsTo(Samsat::class);
    }
}

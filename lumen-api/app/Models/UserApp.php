<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserApp extends Model
{

    protected $table = 'users_app';

    protected $fillable = ['nik', 'nama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'alamat_ktp', 'nomor_hp', 'email', 'pin'];

    public $timestamps = false;

}

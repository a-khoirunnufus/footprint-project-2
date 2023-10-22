<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_pegawai';

    protected $primaryKey = 'id_pegawai';

    protected $fillable = [
        'nama_pegawai',
        'username',
        'password',
        'email',
        'nohp',
        'is_administrator',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
        'is_administrator' => 'boolean',
    ];

    public function getKeyName()
    {
        return 'id_pegawai';
    }
}

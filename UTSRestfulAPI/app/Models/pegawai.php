<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pegawai extends Model
{
    protected $table = 'pegawais';
    protected $fillable = ['nama','jenis_kelamin','alamat','nomor_telepon','email','jabatan','status'];
    public $timestamps = false;
}

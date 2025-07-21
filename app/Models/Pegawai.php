<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
     protected $guarded =[];
     public function pelanggans(){
        return $this->hasMany(Pelanggan::class);
    }

    public function tagihan(){
        return $this->hasMany(Tagihan::class);
    }
    public function posisi(){
        return $this->belongsTo(Posisi::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;
    protected $guarded =[];
    
    public function pelanggans(){
        return $this->hasMany(Pelanggan::class);
    }
    public function tagihan(){
        return $this->hasMany(Pelanggan::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $guarded =[];

    public function tagihan(){
        return $this->hasMany(tagihan::class);
    }

    public function sales(){
        return $this->belongsTo(Sales::class);
    }
}

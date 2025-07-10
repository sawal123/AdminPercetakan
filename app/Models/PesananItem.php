<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananItem extends Model
{
    use HasFactory;
     protected $guarded =['id'];

     public function tagihan(){
        return $this->belongsTo(Tagihan::class);
     }
     public function barang(){
        return $this->belongsTo(Barang::class);
     }
}

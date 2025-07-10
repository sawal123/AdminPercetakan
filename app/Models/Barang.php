<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function bahan()
    {
        return $this->belongsTo(Bahan::class);
    }
     public function pesananItems()
    {
        return $this->hasMany(Bahan::class);
    }
}

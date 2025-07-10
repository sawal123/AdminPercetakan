<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;
    protected $guarded =['id'];

    public function pesananItems()
    {
        return $this->hasMany(PesananItem::class);
    }

    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class);
    }
     public function sales()
    {
        return $this->belongsTo(Sales::class); // jika relasi via pelanggan, ubah nanti
    }
}

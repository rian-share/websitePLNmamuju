<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    protected $table = 'kunjungan';
    protected $guarded = ['id'];

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'petugas_id', 'id');
    }

    public function rating(){
        return $this->hasOne(Rating::class,'kunjungan_id','id');
    }
}

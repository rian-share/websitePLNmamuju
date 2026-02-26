<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    protected $table = 'petugas';
    protected $guarded = ['id'];

    public function petugasQR(){
        return $this->hasOne(Petugas_QR::class, 'petugas_id', 'id');
    }

    public function kunjungan(){
        return $this->hasMany(Kunjungan::class,'petugas_id','id');
    }
}

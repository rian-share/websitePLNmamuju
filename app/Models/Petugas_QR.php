<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petugas_QR extends Model
{
    protected $table = 'petugas_qr';
    protected $guarded = ['id'];

    public function petugas(){
        return $this->belongsTo(Petugas::class, 'petugas_id', 'id');
    }

    
}

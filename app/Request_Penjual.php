<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Pengguna;
use App\Detail_Pesanan;
use App\Produk;
use App\Fakultas;
use App\Jurusan;
use App\Civitas_Akademika;

class Request_Penjual extends Model
{
    protected $table = 'request_mitra';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'id',
        'id_pengguna',
        'status',
        'id_fakultas',
        'id_jurusan',
        'id_civitas_akademika'
    ];
    protected $guarded = [];
    public function Pengguna(){
        return $this->belongsTo(Pengguna::class,'id_pengguna','id');
    }

    public function Fakultas(){
        return $this->belongsTo(Fakultas::class,'id_fakultas','id');
    }

    public function Jurusan(){
        return $this->belongsTo(Jurusan::class,'id_jurusan','id');
    }

    public function Civitas_Akademika(){
        return $this->belongsTo(Civitas_Akademika::class,'id_civitas_akademika','id');
    }

    public function Detail_Pesanan(){
        return $this->belongsTo(Detail_Pesanan::class,'id_pengguna'.'id');
    }

    public function Produk(){
        return $this->belongsTo(Produk::class,'id_pengguna'.'id');
    }
}

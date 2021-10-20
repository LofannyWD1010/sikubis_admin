<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Pengguna;
use App\Detail_Pesanan;
class Pesanan extends Model
{
    protected $table = 'pesanan';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'id_pesanan',
        'foto',
        'ongkir',
        'harga',
        'total_bayar',
        'id_pengguna',
        'status',
    ];
    protected $guarded = [];
    public function Pengguna(){
        return $this->belongsTo(Pengguna::class,'id');
    }

    public function Detail_Pesanan(){
        return $this->belongsToMany(Detail_Pesanan::class,'id_detail');
    }

}

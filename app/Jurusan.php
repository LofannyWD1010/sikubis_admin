<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Fakultas;
use App\Civitas_Akademika;
use App\Request_Penjual;


class Jurusan extends Model
{
    protected $table = 'jurusan';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'id',
        'id_fakultas',
        'nama'
    ];
    protected $guarded = [];

    public function Fakultas(){
        return $this->belongsTo(Fakultas::class,'id_fakultas','id');
    }
    public function Civitas_Akademika(){
        return $this->belongsTo(Civitas_Akademika::class,'id');
    }
    
    public function Request_Penjual(){
        return $this->belongsTo(Request_Penjual::class,'id');
    }

}

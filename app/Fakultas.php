<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Jurusan;
use App\Request_Penjual;


class Fakultas extends Model
{
    protected $table = 'fakultas';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'id',
        'nama'
    ];
    protected $guarded = [];
    
    public function Jurusan(){
        return $this->belongsTo(Jurusan::class,'id');
    }

    public function Request_Penjual(){
        return $this->belongsTo(Request_Penjual::class,'id','id_fakultas');
    }

}

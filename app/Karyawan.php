<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    //
    protected $guarded=[];

    public function jabatan(){
        return $this->belongsTo('App\Jabatan','jabatan_id','id');
    }
    public function status(){
        return $this->belongsTo('App\Status','status_id','id');
    }
    public function pendidikan(){
        return $this->belongsTo('App\Pendidikan','pendidikan_id','id');
    }
    public function telepon(){
        return $this->hasOne('App\Telepon','karyawan_id','id');
    }
}

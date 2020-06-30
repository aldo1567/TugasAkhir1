<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    //
    protected $guarded=[];

    public function karyawan(){
        return $this->hasMany('App\Karyawan','status_id','id');
    }
}

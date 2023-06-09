<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;




class DataMeteranPelanggan extends Model
{





    protected $table    = 'datameteranpelanggan';

    protected $fillable = [
        'nama',
        'no_meteran',
        'start_meteran',
        'rw',
        'rt',
        'alamat',
        'dusun',
        'desa',
        'wa',
        'jenis_saluran',
        'catatan'
    ];


    public static function boot()
    {
        parent::boot();

        DataMeteranPelanggan::observe(new UserActionsObserver);
    }
}

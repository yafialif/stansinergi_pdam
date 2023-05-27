<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;




class TagihanBlanan extends Model
{





    protected $table    = 'tagihanblanan';

    protected $fillable = [
        'datameteranpelanggan_id',
        'awal_meteran',
        'akhir_meteran',
        'total_pemakaian',
        'harga',
        'total_tagihan_bulan_ini',
        'tunggakan_sebelumnya',
        'diskon',
        'total_tagihan',
        'status_tagihan',
        'bulan_tagihan',
        'catatan',
        'nama_petugas',
        'latitude',
        'longitude',
        'id_petugas'
    ];


    public static function boot()
    {
        parent::boot();

        TagihanBlanan::observe(new UserActionsObserver);
    }

    public function datameteranpelanggan()
    {
        return $this->hasOne('App\DataMeteranPelanggan', 'id', 'datameteranpelanggan_id');
    }
}

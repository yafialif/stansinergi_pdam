<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;




class HargaPerMeter3Air extends Model {

    

    

    protected $table    = 'hargapermeter3air';
    
    protected $fillable = [
          'keterangan',
          'harga',
          'if'
    ];
    

    public static function boot()
    {
        parent::boot();

        HargaPerMeter3Air::observe(new UserActionsObserver);
    }
    
    
    
    
}
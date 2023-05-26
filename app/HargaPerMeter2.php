<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;




class HargaPerMeter2 extends Model {

    

    

    protected $table    = 'hargapermeter2';
    
    protected $fillable = [
          'harga',
          'note'
    ];
    

    public static function boot()
    {
        parent::boot();

        HargaPerMeter2::observe(new UserActionsObserver);
    }
    
    
    
    
}
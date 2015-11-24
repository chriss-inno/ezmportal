<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DispatchCustomer extends Model
{
    //
    public function customers()
    {
        return $this::belongsTo('\App\SMSCustomer','customer_id','id');
    }
}

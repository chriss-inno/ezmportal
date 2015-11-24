<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SMSCustomer extends Model
{
    //

    public function distribution()
    {
        return $this::hasOne('\App\DispatchCustomer','customer_id');
    }
}

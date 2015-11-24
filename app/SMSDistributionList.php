<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SMSDistributionList extends Model
{
    //
    public function distribution()
    {
        return $this::hasMany('\App\DispatchCustomer','dispatch_id','id');
    }
}

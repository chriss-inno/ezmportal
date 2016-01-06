<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForexDealSlip extends Model
{
    //
    public function customer()
    {
        return $this::belongsTo('\App\ForexCustomer','counter_party');
    }
}

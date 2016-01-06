<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForexCustomer extends Model
{
    //
    public function dealslips()
    {
        return $this::hasMany('\App\ForexDealSlip','counter_party');
    }
}

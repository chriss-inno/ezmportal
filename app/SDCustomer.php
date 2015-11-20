<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SDCustomer extends Model
{
    //

    public function issues()
    {
        return $this::hasMany('\App\Unit','company_id','id');
    }
}

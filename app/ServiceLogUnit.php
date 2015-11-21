<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceLogUnit extends Model
{
    //
    public function unit()
    {
        return $this::belongsTo('\App\Unit','unit_id');
    }
}

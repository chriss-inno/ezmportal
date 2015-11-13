<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportUnit extends Model
{
    //
    public function unit()
    {
        return $this::belongsTo('\App\Unit','unit_id');
    }
}

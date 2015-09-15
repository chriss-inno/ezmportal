<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    public function branch()
    {
        return $this::belongsTo('\App\Branch','branch_id');
    }
}

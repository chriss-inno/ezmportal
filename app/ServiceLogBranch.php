<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceLogBranch extends Model
{
    //
    public function branch()
    {
        return $this::belongsTo('\App\Branch','branch_id');
    }
}

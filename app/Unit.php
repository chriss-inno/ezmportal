<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //
    public function department()
    {
        return $this::belongsTo('\App\Department','department_id');
    }
    public function subunit()
    {
        return $this::belongsTo('\App\Unit','parent_id');
    }
    public function users()
    {
        return $this::hasMany('\App\User','unit_id','id');
    }
}

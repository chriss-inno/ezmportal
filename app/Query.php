<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Query extends Model
{
    //
    public function fromDepartment()
    {
        return $this::belongsTo('\App\Department','from_department');
    }

    public function toDepartment()
    {
        return $this::belongsTo('\App\Department','to_department');
    }

    public function user()
    {
        return $this::belongsTo('\App\User','reported_by');
    }
    public function module()
    {
        return $this::belongsTo('\App\Module','module_id');
    }
}

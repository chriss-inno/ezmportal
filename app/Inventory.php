<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    //
    public function type()
    {
        return $this::belongsTo('\App\InventoryType','type_id');
    }
    public function branch()
    {
        return $this::belongsTo('\App\Branch','branch_id');
    }
    public function department()
    {
        return $this::belongsTo('\App\Department','department_id');
    }
}

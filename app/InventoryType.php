<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryType extends Model
{
    //
    public function item()
    {
        return $this::hasMany('\App\Inventory','type_id','id');
    }
}

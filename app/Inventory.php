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
}

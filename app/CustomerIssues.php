<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerIssues extends Model
{
    //
    public function producttype()
    {
        return $this::belongsTo('\App\SDProduct','product_id');
    }
    public function productdetails()
    {
        return $this::belongsTo('\App\SDProductDetails','product_details_id');
    }
    public function receiptmode()
    {
        return $this::belongsTo('\App\SDReceiptMode','mode_id');
    }
    public function status()
    {
        return $this::belongsTo('\App\SDStatus','status_id');
    }
    public function department()
    {
        return $this::belongsTo('\App\Department','department_id');
    }
    public function customer()
    {
        return $this::belongsTo('\App\SDCustomer','company_id');
    }
}

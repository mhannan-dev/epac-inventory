<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';


    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier','supplier_id')->withDefault();
    }

    public function units()
    {
        return $this->belongsTo('App\Models\Unit','unit_id')->withDefault();
    }



}

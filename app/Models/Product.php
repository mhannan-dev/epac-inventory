<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';




    public function brands()
    {
        return $this->belongsTo('App\Models\Brand','brand_id')->withDefault();
    }

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier','supplier_id')->withDefault();
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category','category_id')->withDefault();
    }

    public function product_sub_category()
    {
        //return $this->belongsTo('App\Models\SubCategory','sub_category_id')->withDefault();
        return $this->belongsTo(SubCategory::class, 'sub_category_id','id','name');
    }


    public function suppliers()
    {
        return $this->belongsTo('App\Models\Supplier', 'supplier_id')->withDefault();
    }


    public function units()
    {
        return $this->belongsTo('App\Models\Unit','unit_id')->withDefault();
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    protected $fillable = ['brand_id', 'category_id', 'sub_category_id',
        'product_id','invoice_no','selling_qty','date','unit_price','status','selling_price',
        'updated_by','created_by'];



    public function products()
    {
        return $this->belongsTo('App\Models\Product', 'product_id')->withDefault();
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id')->withDefault();
    }

}

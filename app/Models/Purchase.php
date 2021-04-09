<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = 'purchases';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;
    protected $fillable = [
        'date', 'purchase_no', 'supplier_id', 'product_id','unit_id', 'buying_price', 'buying_qty','description', 'created_by', 'status',
    ];


    public function products()
    {
        return $this->belongsTo('App\Models\Product', 'product_id')->withDefault();
    }



    public function unit()
    {
        return $this->belongsTo(Unit::class)->withDefault();
    }




}

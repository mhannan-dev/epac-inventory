<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $appends = ['unitPrice','stock','unitSellingPrice'];

    public function getUnitPriceAttribute(){
        $purchase = $this->purchases->first();
        return $purchase? $purchase->unit_price : 0;
    }

    public function getUnitSellingPriceAttribute(){
        $purchase = $this->purchases->first();
        return $purchase? $purchase->unt_sell_price : 0;
    }

    public function getStockAttribute(){
        return $this->purchases->sum('buying_qty');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id')->withDefault();
    }

    public function units()
    {
        return $this->belongsTo(Unit::class,'unit_id')->withDefault();
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class)->orderBy('id', 'DESC');
    }



}

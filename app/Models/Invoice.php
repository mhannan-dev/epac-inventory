<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['brand_id', 'category_id', 'sub_category_id', 'product_id','invoice_no','unit_id','date','description','status',
        'updated_by','created_by'];
}

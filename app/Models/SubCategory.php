<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table = 'sub_categories';

    protected $fillable = [
        'name','category_id','brand_id','slug','created_by','updated_by'
    ];

    public function prd_brand()
    {
        return $this->belongsTo('App\Models\Brand','brand_id')->withDefault();
    }

    public function prd_category()
    {
        return $this->belongsTo('App\Models\Category','category_id')->withDefault();
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product','id')->withDefault();
    }


}

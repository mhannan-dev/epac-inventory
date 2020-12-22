<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{

    protected $table = 'brands';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','code','description','status'
    ];

}

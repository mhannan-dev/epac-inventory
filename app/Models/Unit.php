<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'units';

    protected $fillable = [
        'name', 'status', 'created_by', 'updated_by'
    ];

    public function getSelectFromData()
    {

        $data = Unit::all();
        //dd($data);
        $response = [];
        if ($data) {
            foreach ($data as $key => $value) {
                $response[$value->id] = $value->name;
            }
        }
        return $response;
    }


    //Display country from countries table
    public function brands()
    {
        return $this->belongsTo('App\Models\Brand', 'brand_id')->withDefault();
    }


}

<?php

namespace App;
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users()
    {
        return $this
            ->hasMany('App\Models\User')->withTimestamps();

    }
}

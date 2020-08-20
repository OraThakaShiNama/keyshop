<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // soft delete

class Book extends Model
{
    use SoftDeletes;
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function orders(){
        return $this->belongsToMany('App\Order');
    }
}

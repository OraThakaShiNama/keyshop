<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // soft delete

class Category extends Model
{
    use SoftDeletes; // soft delete

    public function books()
    {
        return $this->belongsToMany('App\Book');
    }
}

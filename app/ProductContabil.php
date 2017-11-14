<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductContabil extends Model
{
    public $fillable = ['name', 'details'];

    public function user()
    {
        return $this->belongsTo('App\ProductContabil');
    }
}

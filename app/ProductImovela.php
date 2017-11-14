<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImovela extends Model
{
    public $fillable = ['name', 'details'];

    public function user()
    {
        return $this->belongsTo('App\ProductImovela');
    }
}

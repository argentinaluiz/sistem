<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImovelg extends Model
{
    public $fillable = ['name', 'details'];

    public function user()
    {
        return $this->belongsTo('App\ProductImovelg');
    }
}

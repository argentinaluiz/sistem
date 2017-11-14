<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTecfins extends Model
{
    public $fillable = ['name', 'detatails'];

    public function user()
    {
        return $this->belongsTo('App\ProductTecfins');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $fillable = [
        'idCategory', 'name', 'slug', 'status'
    ];

    public function Product()
    {
        return $this->belongsTo('App\Models\Product','idProduct','id');
    }
}

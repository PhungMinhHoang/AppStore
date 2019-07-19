<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'quantity', 'price', 'promotional', 'idCategory', 'idProduct', 'status'
    ];

    public  function productType(){
        return $this->hasMany('App\Models\ProductType','idProductType','id');
    }

    public function Category()
    {
        return $this->belongsTo('App\Models\Category','idCategory','id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    protected $fillable = [
        'idUser', 'message'
    ];

    public function User()
    {
        return $this->belongsTo('App\Models\User','idUser','id');
    }
}

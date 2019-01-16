<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Count extends Model
{
    protected $fillable = [
        'name', 'number', 'year', 'public', 'num'
    ];

    protected $dates = ['publish'];
}
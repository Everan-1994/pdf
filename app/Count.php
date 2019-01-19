<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Count extends Model
{
    protected $fillable = [
        'name', 'number', 'year', 'publish', 'num'
    ];

    protected $dates = ['publish'];

    public function statistics() 
    {
    	return $this->hasMany(Statistic::class, 'count_id', 'id');
    }
}
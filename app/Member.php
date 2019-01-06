<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'number', 'name', 'group_id', 'id_card'
    ];

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }
}
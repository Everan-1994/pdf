<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    protected $fillable = [
        'count_id', 'month', 'organ', 'pension', 'medical', 'unemployment',
        'work_injury', 'fertility', 'status'
    ];
}
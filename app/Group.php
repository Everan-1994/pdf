<?php
/**
 * Created by PhpStorm.
 * User: everan
 * Date: 2019/1/6
 * Time: 1:14 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['name', 'publish', 'number', 'date'];

    protected $dates = ['publish'];

    public function members()
    {
        return $this->hasMany(Member::class, 'group_id', 'id');
    }
}
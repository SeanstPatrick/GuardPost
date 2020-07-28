<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts_Status extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
       ];
}

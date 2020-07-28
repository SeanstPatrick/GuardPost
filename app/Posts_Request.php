<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts_Request extends Model
{
    //

    protected $fillable = [
        'post_id',
        'security_id',
        'status',
        'created_at',
        'updated_at',
    ];
}

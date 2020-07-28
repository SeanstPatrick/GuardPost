<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'created_by',
        'assigned_to',
        'description',
        'rate',
        'street',
        'city',
        'prov',
        'postcode',
        'security_rating',
        'height',
        'weight',
        'female_guards',
        'male_guards',
        'status',
        'start_date_time',
        'end_date_time',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}

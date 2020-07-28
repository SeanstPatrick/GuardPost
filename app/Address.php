<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Address extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'address_type',
        'street',
        'city',
        'province',
        'postal_code',
    ];


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Address
     */
    protected function create_address(array $data, $id, $type)
    {
        return Address::create([
            'user_id' => $id,
            'address_type' => $type,
            'street' => $data['address'],
            'city' => $data['city'],
            'province' => $data['prov'],
            'postal_code' => $data['postcode'],
        ]);
    }
}

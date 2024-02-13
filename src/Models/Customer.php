<?php

namespace JSCustom\Chargify\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'chargify_customers';

    protected $fillable = [
        'customer_id',
        'first_name',
        'last_name',
        'organization',
        'email',
        'address',
        'address_2',
        'city',
        'state',
        'zip',
        'country',
        'phone'
    ];

    protected $casts = [
        'id' => 'integer',
        'customer_id' => 'integer',
        'first_name' => 'string',
        'last_name' => 'string',
        'organization' => 'string',
        'email' => 'string',
        'address' => 'string',
        'address_2' => 'string',
        'city' => 'string',
        'state' => 'string',
        'zip' => 'string',
        'country' => 'string',
        'phone' => 'string'
    ];
}

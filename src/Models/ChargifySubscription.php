<?php

namespace JSCustom\Chargify\Models;

use Illuminate\Database\Eloquent\Model;

class ChargifySubscription extends Model
{
    protected $fillable = [
        'subscription_id',
        'customer_id',
        'product_id'
    ];

    protected $casts = [
        'id' => 'integer',
        'subscription_id' => 'integer',
        'customer_id' => 'integer',
        'product_id' => 'integer'
    ];
}

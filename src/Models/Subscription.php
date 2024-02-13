<?php

namespace JSCustom\Chargify\Models;

use Illuminate\Database\Eloquent\{
    Model,
    SoftDeletes
};

class Subscription extends Model
{
    use SoftDeletes;

    protected $table = 'chargify_subscriptions';

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

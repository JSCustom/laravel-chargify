<?php

namespace JSCustom\Chargify\Models;

use Illuminate\Database\Eloquent\Model;

class ChargifyProduct extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'handle',
        'description',
        'interval',
        'interval_unit',
        'tax_code',
        'product_price_point_id'
    ];

    protected $casts = [
        'id' => 'integer',
        'product_id' => 'integer',
        'name' => 'string',
        'handle' => 'string',
        'description' => 'string',
        'interval' => 'integer',
        'interval_unit' => 'string',
        'tax_code' => 'string',
        'product_price_point_id' => 'integer'
    ];
}

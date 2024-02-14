<?php

namespace JSCustom\Chargify\Models;

use Illuminate\Database\Eloquent\{
    Model,
    SoftDeletes
};

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'chargify_products';

    protected $fillable = [
        'product_id',
        'name',
        'handle',
        'description',
        'accounting_code',
        'require_credit_card',
        'price_in_cents',
        'interval',
        'interval_unit',
        'auto_create_signup_page',
        'tax_code'
    ];

    protected $casts = [
        'id' => 'integer',
        'product_id' => 'integer',
        'name' => 'string',
        'handle' => 'string',
        'description' => 'string',
        'accounting_code' => 'string',
        'require_credit_card' => 'boolean',
        'price_in_cents' => 'integer',
        'interval' => 'integer',
        'interval_unit' => 'string',
        'auto_create_signup_page' => 'boolean',
        'tax_code' => 'string'
    ];
}

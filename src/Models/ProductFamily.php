<?php

namespace JSCustom\Chargify\Models;

use Illuminate\Database\Eloquent\{
    Model,
    SoftDeletes
};

class ProductFamily extends Model
{
    use SoftDeletes;

    protected $table = 'chargify_product_families';

    protected $fillable = [
        'product_family_id',
        'name',
        'description',
        'handle',
        'accounting_code'
    ];

    protected $casts = [
        'id' => 'integer',
        'product_family_id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'handle' => 'string',
        'accounting_code' => 'string'
    ];
}

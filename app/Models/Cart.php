<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Cart extends Eloquent
{
    // use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'cart';

    protected $fillable = [
        'product', 'quantity', 'is_checkout'
    ];
}

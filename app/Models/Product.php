<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Product extends Eloquent
{
    // use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'products';

    protected $fillable = [
        'product_name', 'stock', 'price', 'category', 'weight', 'description'
    ];
}

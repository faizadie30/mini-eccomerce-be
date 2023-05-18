<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Image extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'images';

    protected $fillable = [
        'path', 'url'
    ];
}

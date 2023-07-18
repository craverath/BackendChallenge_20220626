<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'code',
        'barcode',
        'status',
        'imported_t',
        'url',
        'product_name',
        'quantity',
        'categories',
        'packaging',
        'brands',
        'image_url',
    ];
}
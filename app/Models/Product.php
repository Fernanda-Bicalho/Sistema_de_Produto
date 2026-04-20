<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'product_description',
        'price',
        'category_id'
    ];

    /**
     * Get the category that owns the product.
     */
    public function category()
    {

        return $this->belongsTo(Category::class);
    }
}
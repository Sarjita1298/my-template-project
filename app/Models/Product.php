<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'category_id',
        'product_name',
        'discount_percentage',
        'product_short_description',
        'product_long_description',
        'product_price',
        'product_review_star',
        'product_image',
        'rating',
        'popularity'
    ];

    /**
     * Indicates if the model should be timestamped.
     */
    public $timestamps = true;

    /**
     * Get the key used for route model binding.
     */
    public function getRouteKeyName(): string
    {
        return 'id';
    }

    /**
     * A product belongs to a category.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}

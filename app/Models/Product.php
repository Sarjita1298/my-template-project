<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    // Mass assignable fields
    protected $fillable = [
        'category_id',
        'product_name',
        'discount_percentage',
        'product_short_description',
        'product_long_description',
        'product_price',
        'product_review_star',
        'product_image',
    ];

    // Enable timestamps
    public $timestamps = true;

    // Use 'id' for route model binding
    public function getRouteKeyName(): string
    {
        return 'id';
    }

    /**
     * Product belongs to a Category.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
        // Explicitly specify foreign and owner keys (optional if using Laravel conventions)
    }
}

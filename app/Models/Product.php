<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id','name', 'image'];

    public $timestamps = true;
    
    public function getRouteKeyName()
    {
        return 'id';
    }
public function category()
{
    return $this->belongsTo(Category::class);
}

}

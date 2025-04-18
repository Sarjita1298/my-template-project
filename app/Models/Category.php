<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['image', 'name', 'slug'];

    public $timestamps = true;
    
    public function getRouteKeyName()
    {
        return 'id';
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }

 
}

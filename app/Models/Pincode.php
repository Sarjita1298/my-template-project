<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pincode extends Model
{
    protected $fillable = ['code', 'district_id'];

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}

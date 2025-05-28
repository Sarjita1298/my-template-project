<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


    class Report extends Model
{
    protected $fillable = ['order_id', 'customer_name', 'total_price', 'order_date', 'order_status' ,'shipping_status'];

    protected $dates = ['order_date'];
}



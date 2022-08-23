<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orderitem extends Model
{
    protected $table = 'orderitems';

    public function order()
    {
        return $this->hasOne(Order::class,'id','order_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class,'id','product_id');
    }
}

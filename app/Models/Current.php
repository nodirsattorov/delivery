<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Current extends Model
{
    protected $table = 'current';

    public function orders()
    {
        return $this->hasMany(Order::class,'tg_user_id','tg_user_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $table = 'category';

    protected $fillable = [
        'name_uz', 'name_ru', 'parent_id', 'has_subcategory'
    ];

    public function products()
    {
        return $this->hasMany(Product::class,'category_id','id');
    }
    public function parent()
    {
        return $this->hasOne(Category::class,'id','parent_id');
    }
}

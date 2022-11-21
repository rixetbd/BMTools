<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    function getCategoryName(){
        return $this->belongsTo(Category::class, 'category_id')->withDefault([
            'id' => '',
            'name' => 'N/A',
        ]);
    }

    function getSubCategoryName(){
        return $this->belongsTo(SubCategory::class, 'subcategory_id')->withDefault([
            'id' => '',
            'name' => 'N/A',
        ]);
    }

}

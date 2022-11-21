<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    function getCategoryName(){
        return $this->belongsTo(Category::class, 'category_id')->withDefault([
            'id' => '',
            'name' => 'N/A',
        ]);
    }
}

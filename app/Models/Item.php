<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'item_name',
        'item_price',
        'item_quantity',
        'picture_path',
    ];

    public function Category() {
        return $this->belongsTo(Category::class);
    }
}
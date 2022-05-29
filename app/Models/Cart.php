<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_id',
        'quantity',
    ];

    protected $table = 'cart';
    
    public function Item() {
        return $this->belongsTo(Item::class, "item_id", "id");
    }
}

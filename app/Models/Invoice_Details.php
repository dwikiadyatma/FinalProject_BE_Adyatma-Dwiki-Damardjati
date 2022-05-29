<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice_Details extends Model
{
    use HasFactory;

    protected $table = 'Invoice_Details';

    protected $fillable = [
        'invoice_history_id',
        'item_id',
        'quantity',
    ];

    public function Item() {
        return $this->hasOne(Item::class, 'id', 'item_id');
    }
}

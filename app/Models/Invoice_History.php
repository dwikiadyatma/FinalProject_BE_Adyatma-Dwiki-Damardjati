<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice_History extends Model
{
    use HasFactory;

    protected $table = 'Invoice_History';

    protected $fillable = [
        'user_id',
        'address',
        'postcode',
    ];

    public function Invoice_Details() {
        return $this->hasMany(Invoice_Details::class);
    }
    public function User() {
        return $this->hasMany(User::class);
    }
}

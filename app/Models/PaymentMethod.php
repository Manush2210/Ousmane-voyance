<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = [
        'name',
        'code',
        'description',
        'instructions',
        'motifs',
        'is_active',
        'logo',
        'receiver_firstname',
        'receiver_lastname',
        'receiver_country',
        'address'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relationship to orders
    public function orders()
    {
        return $this->hasMany(Order::class, 'payment_method', 'code');
    }
}

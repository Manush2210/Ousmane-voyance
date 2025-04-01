<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public $fillable = [
        'owner',
        'bank',
        'iban',
        'swift',
        'address',
        'country',
        'is_active',
        'appointment_pricing',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Récupère le dernier compte bancaire actif
    public static function getLastActive()
    {
        return self::where('is_active', true)
            ->latest()
            ->first();
    }
}

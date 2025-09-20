<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'message',
        'rating',
        'photo',
        'is_active',
        'created_at'
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_active' => 'boolean',
        'created_at' => 'datetime'
    ];

    /**
     * Scope pour récupérer uniquement les témoignages actifs
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope pour récupérer les témoignages par rating
     */
    public function scopeByRating($query, $rating)
    {
        return $query->where('rating', $rating);
    }

    /**
     * Accessor pour l'URL de la photo
     */
    public function getPhotoUrlAttribute()
    {
        if ($this->photo) {
            return asset('storage/' . $this->photo);
        }
        return null;
    }

    /**
     * Accessor pour afficher les étoiles
     */
    public function getStarsAttribute()
    {
        return str_repeat('★', $this->rating) . str_repeat('☆', 5 - $this->rating);
    }

    /**
     * Accessor pour l'initiale du nom
     */
    public function getInitialAttribute()
    {
        return strtoupper(substr($this->name, 0, 1));
    }

    /**
     * Accessor pour la date formatée
     */
    public function getFormattedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}

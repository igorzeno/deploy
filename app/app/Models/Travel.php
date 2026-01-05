<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Travel extends Model
{
    /** @use HasFactory<\Database\Factories\TravelFactory> */
    use HasFactory;

    protected $table = 'travels';

    protected $fillable = [
        'is_public',
        'name',
        'type',
        'number_of_days',
    ];

    /**
     * @return HasMany
     */
    public function tours(): HasMany
    {
        return $this->hasMany(Tour::class);
    }
}

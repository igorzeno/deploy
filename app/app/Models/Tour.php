<?php

namespace App\Models;

use App\Casts\PriceCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    /** @use HasFactory<\Database\Factories\TourFactory> */
    use HasFactory;

    protected $casts = [
        'price' => PriceCast::class,
    ];

    protected $fillable = [
        'travel_id',
        'name',
        'description',
        'status',
        'starting_date',
        'ending_date',
        'price'
    ];

    public function travel()
    {
        return $this->belongsTo(Travel::class);
    }

}

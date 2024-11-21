<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'name',
        'development_type',
        'residential_levels',
        'basement_parking_levels',
        'podium_parking_levels',
        'lower_ground_floor_parking_levels',
        'commercial_units',
        'path',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

}
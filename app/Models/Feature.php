<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'feature_name',
        'image_path', // Assuming this is the column for storing the image path
    ];
}

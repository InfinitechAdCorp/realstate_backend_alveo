<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
      protected $fillable = ['name','location','specific_location','location_image', 'lat', 'lng'];
          public function property()
    {
        return $this->belongsTo(Property::class);
    }
}

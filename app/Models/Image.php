<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    // Specify the table if necessary
    protected $table = 'images'; // Optional if your table is named 'images'

    // Define fillable attributes to allow mass assignment
  protected $fillable = ['image_path', 'property_id','name'];

    // Optional: Define a relationship if this model is related to another model (e.g., Property)
    public function property()
    {
        return $this->belongsTo(Property::class); // Adjust this if your relationship is different
    }

    // Additional methods can be defined for more functionality if needed
}

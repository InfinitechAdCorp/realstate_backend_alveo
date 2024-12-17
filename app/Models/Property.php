<?php

namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Property extends Model
    {
        use HasFactory;

        // Specify the table if it's not plural of the model name
        protected $table = 'properties';
    protected $casts = [
        'lat' => 'float',
        'lng' => 'float',
    ];
        // Define the fillable fields
        protected $fillable = [
            'key',
            'name',
            'status',
            'location',
            'lat',
            'lng',
            'specific_location',
            'price_range',
            'units',
            'land_area',
            'development_type',
            'architectural_theme',
            'path',
            'view',
            
            'features',
            'image_path', 
            'property_id',
            'name'
        ];

        // Relationships
    public function facilities()
    {
        return $this->belongsToMany(Facility::class);
    }

    public function features()
    {
        return $this->hasMany(Feature::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }
    }

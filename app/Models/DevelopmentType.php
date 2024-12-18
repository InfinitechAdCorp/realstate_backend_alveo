<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevelopmentType extends Model
{
    use HasFactory;

    protected $table = "development_type";
    
    protected $fillable = [
        "name"
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchitecturalTheme extends Model
{
    use HasFactory;

    protected $table = "architectural_theme";
    
    protected $fillable = [
        "name"
    ];
}

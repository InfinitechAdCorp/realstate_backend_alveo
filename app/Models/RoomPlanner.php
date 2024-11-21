<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomPlanner extends Model
{
    use HasFactory;
    protected $table = 'roomplanner'; // Explicitly specify the table name

    protected $fillable = [
        'name',
        'picture',
        'width',
        'height',
        'category',
        'created_at',
        'updated_at',
    ];
}

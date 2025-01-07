<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmitProperty extends Model
{
    use HasFactory;

    protected $table = "submit_property";

    protected $fillable =[
           'first_name',
        'last_name',
        'email',
        'phone',
        'property_name',
        'location',
        'price',
        'status',
        'description',
        'files',
    ];
       protected $casts = [
        'files' => 'array', // Cast the 'files' column as an array (store JSON)
    ];
}

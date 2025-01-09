<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetAppointment extends Model
{
    use HasFactory;

    protected $table = 'set_appointment';  
    protected $fillable = [
        'fullname',
        'datetime',
        'email',
        'number',
        'reason',
        'property',
        'message',
        'status',
    ];
     protected $casts = [
    'datetime' => 'datetime', // Treat 'datetime' as a Carbon instance
];


}

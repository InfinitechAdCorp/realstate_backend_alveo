<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chatbot extends Model
{
    use HasFactory;

 protected $table = 'chatbot'; // Specify the table name

    protected $fillable = ['question', 'answer'];
}
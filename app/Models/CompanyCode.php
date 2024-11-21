<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyCode extends Model
{
    use HasFactory;

    // Define the table name (optional if the table follows Laravel's naming convention)
   
    protected $table = 'companycode'; // Ensure this matches the table name
    protected $fillable = ['status', 'code']; // Fillable fields

    // If you're using timestamps (created_at, updated_at)
    public $timestamps = true;
}

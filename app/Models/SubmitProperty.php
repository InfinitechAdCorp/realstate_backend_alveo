<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmitProperty extends Model
{
    use HasFactory;

    protected $table = "submit_property";

    protected $fillable =[
        "last_name",
        "first_name",
        "email",
        "number",
        "property_name",
        "unit_type",
        "price",
        "location",
        "images",
    ];
}

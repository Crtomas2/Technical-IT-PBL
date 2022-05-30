<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promodisers extends Model
{
    use HasFactory;
    protected $fillable = ['promodiser_id','Firstname','Lastname','Mobilenumber','Location_code'];
}

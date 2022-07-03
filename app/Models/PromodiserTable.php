<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromodiserTable extends Model
{
    use HasFactory;
    protected $fillable = [
        'firstname',
        'lastname',
        'location_code',
    ];
}

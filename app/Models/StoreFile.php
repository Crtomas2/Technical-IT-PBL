<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreFile extends Model
{
    use HasFactory;
    protected $fillable = [
        'storename',
        'storelocation',
        'location_code',
        'store_group'
    ];
}

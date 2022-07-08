<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempData extends Model
{
    use HasFactory;
    protected $fillable = [
        'barcode_number',
        'color',
        'size_code',
        'unit_measure',
        'barcode_class'

    ];
}

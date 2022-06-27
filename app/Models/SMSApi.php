<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SMSApi extends Model
{
    use HasFactory;
    protected $fillable = [
      'barcode_number',
      'Store_name'
    ];
}

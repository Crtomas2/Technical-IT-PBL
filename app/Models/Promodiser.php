<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promodiser extends Model
{
    use HasFactory;
    protected $fillable = ['Firstname','Middlename','lastname','mobilenumber','Storename','Storelocation','LocationCode','StoreGroup'];
}

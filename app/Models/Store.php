<?php

namespace App\Models;

use Illuminate\Support\Facades\App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Store extends Model
{
  protected $fillable = ['Storename'];

  public function promodisers()
  {
    return $this->hasMany(Promodisers::class);
  }
}

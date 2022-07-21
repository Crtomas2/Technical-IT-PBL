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
        'mobile_number',
    ];

    /**
     * Get the related location assignment
     * 
     * 
     */
    public function assignments()
    {
        return $this->hasMany(PromodiserAssignation::class);
    }

    /**
     * Get the latest location assignment
     */
    public function latest_assignment()
    {
        return $this->hasOne(PromodiserAssignation::class)->latest();
    }
}

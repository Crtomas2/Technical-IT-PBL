<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromodiserAssignation extends Model
{
    use HasFactory;

    protected $fillable = [
        'promodisers_id',
        'location_codes_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Get the location of the current location
     */
    public function location()
    {
        return $this->belongsTo(LocationCode::class, 'location_codes_id');
    }
}

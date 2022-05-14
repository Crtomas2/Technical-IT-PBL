<?php

namespace App\Models;

use App\Models\Storelocation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoreItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'storelocation_id',
        'locationcode_id',
        'storegroup_id',
    ];

    public function storeName()
    {
        $this->belongsTo(Store::class);
    }

    public function storeLocation()
    {
        $this->belongsTo(Storelocation::class);
    }

    public function locationCode()
    {
        $this->belongsTo(LocationCode::class);
    }

    public function storeGroup()
    {
        $this->belongsTo(Storegroup::class);
    }
}

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

    protected $with = [
        'storeName',
        'storeLocation',
        'locationCode',
        'storeGroup'
    ];



    public function storeName()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function storeLocation()
    {
        return $this->belongsTo(Storelocation::class, 'storelocation_id');
    }

    public function locationCode()
    {
        return $this->belongsTo(LocationCode::class, 'locationcode_id');
    }

    public function storeGroup()
    {
        return $this->belongsTo(Storegroup::class, 'storegroup_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CateringTier extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'photo',
        'tagline',
        'quantity',
        'price',
        'duration',
        'catering_package_id'
    ];

    public function cateringPackage()
    {
        return $this->belongsTo(CateringPackage::class);
    }

    public function benefits()
    {
        return $this->hasMany(TierBenefit::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(CateringSubscription::class);
    }
}

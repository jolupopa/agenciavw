<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandDetail extends Model
{
    /** @use HasFactory<\Database\Factories\LandDetailsFactory> */
    use HasFactory;


    protected $fillable = [
        'area_sq_meters',
        'soil_type',
        'price',
    ];

    /**
     * Get the property that owns the land details.
     */
    public function property()
    {
        return $this->morphOne(Property::class, 'property');
    }
}

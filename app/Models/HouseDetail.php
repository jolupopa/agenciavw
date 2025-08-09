<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseDetail extends Model
{
    /** @use HasFactory<\Database\Factories\ApartamentDetailsFactory> */
    use HasFactory;

      protected $fillable = [

            'subtitle',
		    'price',
            'detalle',
            'area_total',
            'bedrooms',
            'bathrooms',
            'num_pisos',
            'num_cuartos',
            'num_cars',
            'has_garage',
            'url_video',
			'url_plano',
			'url_plano2',
    ];

    /**
     * Get the property that owns the apartment details.
     */
    public function property()
    {
        return $this->morphOne(Property::class, 'property');
    }
}

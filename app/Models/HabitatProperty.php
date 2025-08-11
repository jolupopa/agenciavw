<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HabitatProperty extends Model
{
    /** @use HasFactory<\Database\Factories\ApartamentDetailsFactory> */
    use HasFactory;

      protected $fillable = [

            'property_id',
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
     * Get the property that own property.
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}

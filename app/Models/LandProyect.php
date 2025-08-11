<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LandProyect extends Model
{
     /** @use HasFactory<\Database\Factories\LandDetailsFactory> */
    use HasFactory;


    protected $fillable = [
        'proyect_id',
        'area',
        'price',
    ];

    /**
     * Get the property that owns the land details.
     */

    public function property(): BelongsTo
    {
        return $this->belongsTo(Proyect::class);
    }
}

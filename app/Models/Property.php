<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;


class Property extends Model
{
    /** @use HasFactory<\Database\Factories\PropertyFactory> */
    use HasFactory;

    protected $fillable = [
        'code',
        'title',
        'address',

        'longitud',
        'latitud',

        'parent_id',
        'property_id',
        'property_type',

        'visibilidad',
        'estado',
        'active',

        'zona_id',
        'distrito_id',
        'provincia_id',
        'departamento_id',

        'category_id',
        'user_id',
        'typeproperty_id',

        'published_at',
        'published_end',
    ];

    protected $casts = [
         //'estado' => EstadoPropertyEnum::class,
        //'visibilidad' => VisibilidadPropertyEnum::class,
        'active' => 'boolean',
        'published_at' => 'datetime:d-m-Y',
        'published_end' => 'datetime:d-m-Y',
    ];

    /**
     * Get the parent property.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Property::class, 'parent_id');
    }

    /**
     * Get the child properties.
     */
    public function children(): HasMany
    {
        return $this->hasMany(Property::class, 'parent_id');
    }

     /**
     * Get the parent model for the polymorphic relation.
     */
    public function property(): MorphTo
    {
        return $this->morphTo();
    }

      public function typeproperty(): BelongsTo
	{
		return $this->belongsTo(Typeproperty::class, 'typeproperty_id');
	}


	public function distrito(): BelongsTo
	{
		return $this->belongsTo(Distrito::class, 'distrito_id');
	}

    public function provincia(): BelongsTo
	{
		return $this->belongsTo(Provincia::class, 'provincia_id');
	}

    public function departamento(): BelongsTo
	{
		return $this->belongsTo(Departamento::class, 'departamento_id');
	}

    public function zona(): BelongsTo
    {
        return $this->belongsTo(Zona::class, 'zona_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'caregory_id');
    }

    public function user(): BelongsTo
    {
		return $this->belongsTo(User::class);
	}

}

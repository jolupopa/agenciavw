<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Provincia extends Model
{
      protected  $fillable = ['name', 'slug',  'departamento_id' ];

        public function departamento(): BelongsTo
    {
        return $this->belongsTo(Departamento::class);
    }

    public function distritos(): HasMany
    {
        return $this->hasMany(Distrito::class);
    }

    public function zonas(): HasMany
    {
        return $this->hasMany(Distrito::class);
    }
}

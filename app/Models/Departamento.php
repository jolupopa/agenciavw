<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Departamento extends Model
{
       protected  $fillable = ['name', 'slug' ];

         public function provincias(): HasMany
    {
        return $this->hasMany(Provincia::class);
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

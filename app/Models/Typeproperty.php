<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Typeproperty extends Model
{
     protected $fillable = [
        'name',
        'active',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'active' => 'boolean',
        ];
    }
}

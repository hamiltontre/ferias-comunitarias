<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Emprendedor extends Model
{
    protected $fillable = [
        'nombre',
        'telefono',
        'rubro'
    ];

    // Relación muchos a muchos con Feria
    public function ferias(): BelongsToMany
    {
        return $this->belongsToMany(Feria::class, 'feria_emprendedor');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Feria extends Model
{
    // Campos que se pueden llenar con create() o update()
    protected $fillable = [
        'nombre',
        'fecha',
        'lugar',
        'descripcion'
    ];

    // Relación muchos a muchos con Emprendedor
    public function emprendedores(): BelongsToMany
    {
        return $this->belongsToMany(Emprendedor::class, 'feria_emprendedor');
    }
}
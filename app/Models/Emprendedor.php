<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Emprendedor extends Model
{
    protected $table = 'emprendedores';
    
    protected $fillable = [
        'nombre',
        'telefono',
        'rubro',
        'descripcion'
    ];

    public function ferias(): BelongsToMany
    {
        return $this->belongsToMany(Feria::class, 'feria_emprendedor');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feria extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'fecha', 'lugar', 'descripcion'];
    
    // Añade esto para convertir automáticamente el campo a Carbon
    protected $casts = [
        'fecha' => 'date:d/m/Y', // Formato de fecha
    ];
    
    public function emprendedores()
    {
        return $this->belongsToMany(Emprendedor::class, 'feria_emprendedor');
    }
}

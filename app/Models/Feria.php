<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feria extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'fecha', 'lugar', 'descripcion'];
    
    // Agregar esto para convertir automáticamente el campo fecha a Carbon
    protected $dates = ['fecha'];

    public function emprendedores()
    {
        return $this->belongsToMany(Emprendedor::class, 'feria_emprendedor');
    }
}
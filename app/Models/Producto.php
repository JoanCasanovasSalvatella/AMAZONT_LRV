<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Opinion;
use App\Models\Valoracion;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'oferta',
        'imagen',
        'descripcion',
        'precio',
        'precioAnterior',
        'cat_id'
    ];

    // Relación con el modelo Opinion
    public function opiniones()
    {
        return $this->hasMany(Opinion::class, 'prod_id');
    }

    // Relación con el modelo Valoracion
    public function valoraciones()
    {
        return $this->hasMany(Valoracion::class, 'prod_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;
use App\Models\User;
use App\Models\Opinion;
use App\Models\Valoracion;
use App\Models\Carrito;
use App\Models\Compra;

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
        'cantidad',
        'cat_id',
        'user_id'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'cat_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

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

    public function carritos()
    {
        return $this->hasMany(Carrito::class, 'prod_id');
    }

    public function compras()
    {
        return $this->hasMany(Compra::class, 'prod_id');
    }
}

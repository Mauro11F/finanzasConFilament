<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = [
        'name',
        'tipo',
    ];

    // Relación de 1-N con el modelo Movimiento
    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }

    // Relación de N-1 con el modelo User
    public function presupuestos()
    {
        return $this->hasMany(Presupuesto::class);
    }

}

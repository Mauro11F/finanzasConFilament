<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presupuesto extends Model
{
    protected $fillable = [
        'user_id',
        'categoria_id',
        'monto_asignado',
        'monto_gastado',
        'fecha',
    ];

    // Relación de N-1 con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación de N-1 con el modelo Categoria
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}

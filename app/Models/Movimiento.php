<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $fillable = [
        'user_id',
        'categoria_id',
        'tipo',
        'monto',
        'descripcion',
        'foto',
        'fecha',
    ];


    // relacion de N-1 con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }


    // Metodo para actualizar el monto gastado cuando se creo un movimiento
    protected static function booted()
    {
        static::created(function ($movimiento) {
            if ($movimiento->tipo === 'gasto') {
                // Buscar el presupuesto correspndiente
                $presupuesto = Presupuesto::where('user_id', $movimiento->user_id)
                    ->where('categoria_id', $movimiento->categoria_id)
                    ->whereMonth('fecha', now()->month)
                    ->whereYear('fecha', now()->year)
                    ->first();
                
                if ($presupuesto) {
                    $presupuesto->monto_gastado += $movimiento->monto;
                    $presupuesto->save();
                }
            }
        });
    }

}

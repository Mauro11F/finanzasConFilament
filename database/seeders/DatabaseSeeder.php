<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Mauro Franco',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'), // Contraseña: admin123
        ]);
        User::create([
            'name' => 'Cristina Quintana',
            'email' => 'cris@gmail.com',
            'password' => Hash::make('12345678'), // Contraseña: 12345678
        ]);
        User::create([
            'name' => 'Jorge Eduardo',
            'email' => 'jorge@gmail.com',
            'password' => Hash::make('12345678'), // Contraseña: 12345678
        ]);

        Categoria::create(['name'=> 'Alimentos', 'tipo' => 'gasto' ]);
        Categoria::create(['name'=> 'Programa Ventas', 'tipo' => 'entrada' ]);
        Categoria::create(['name'=> 'Pago Internet', 'tipo' => 'gasto' ]);
        Categoria::create(['name'=> 'Servicio Tecnico', 'tipo' => 'entrada' ]);
        Categoria::create(['name'=> 'Gestion de Stock', 'tipo' => 'entrada' ]);
        Categoria::create(['name'=> 'Venta Celular', 'tipo' => 'entrada' ]);
        Categoria::create(['name'=> 'Gestion de Vinanzas', 'tipo' => 'entrada' ]);
        Categoria::create(['name'=> 'Pago de Luz', 'tipo' => 'gasto' ]);
        Categoria::create(['name'=> 'Boleta de Agua', 'tipo' => 'gasto' ]);
        Categoria::create(['name'=> 'Sistema Escolar', 'tipo' => 'entrada' ]);

    }
}

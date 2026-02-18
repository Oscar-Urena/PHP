<?php

namespace Database\Seeders;

use App\Models\Noticia;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Noticia::create([
            'titulo'    => 'Oferta especial en vuelos',
            'texto'     => 'Descuentos de hasta el 50% en vuelos nacionales',
            'categoria' => 'ofertas',
            'imagen'    => null,
            'fecha'     => now()->toDateString(),
        ]);

        Noticia::create([
            'titulo'    => 'Promoción de verano',
            'texto'     => 'Reserva tu hotel con desayuno incluido',
            'categoria' => 'promociones',
            'imagen'    => null,
            'fecha'     => now()->toDateString(),
        ]);

        Noticia::create([
            'titulo'    => 'Playas del mediterráneo',
            'texto'     => 'Las mejores playas de la costa mediterránea',
            'categoria' => 'costas',
            'imagen'    => null,
            'fecha'     => now()->toDateString(),
        ]);

        Noticia::create([
            'titulo'    => 'Black Friday anticipado',
            'texto'     => 'Grandes descuentos en paquetes turísticos',
            'categoria' => 'ofertas',
            'imagen'    => null,
            'fecha'     => now()->toDateString(),
        ]);

        Noticia::create([
            'titulo'    => 'Costa Brava en otoño',
            'texto'     => 'Descubre la Costa Brava fuera de temporada',
            'categoria' => 'costas',
            'imagen'    => null,
            'fecha'     => now()->toDateString(),
        ]);

        Usuario::create([
            'id' => '1',
            'usuario' => 'admin',
            'clave' => 'admin',
        ]);

        Usuario::create([
            'id' => '2',
            'usuario' => '1234',
            'clave' => '1234',
        ]);
    }
}

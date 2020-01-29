<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Categoria_TrabajosFakerTableSeeder::class);
        $this->call(CiudadesFakerTableSeeder::class);
        $this->call(EmpresasFakerTableSeeder::class);
        $this->call(Oferta_TrabajosFakerTableSeeder::class);
        $this->call(UsuariosFakerTableSeeder::class);
        $this->call(SolicitudesFakerTableSeeder::class);
    }
}

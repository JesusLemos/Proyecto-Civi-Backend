<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Oferta_TrabajosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            DB::table('oferta_trabajos')->insert([
                'titulo' => Str::random(10),
                'descripcion_oferta' => Str::random(15),
                'popularidad' => rand(0, 100),
                'anuncio' => rand(0, 1),
                'id_empresa' => rand(1, 10),
                'id_categoria' =>  rand(1, 10),
                'id_ciudad' =>  rand(1, 10),
                'fecha_publicacion' => date('Y-m-d')
            ]);
        }
    }
}

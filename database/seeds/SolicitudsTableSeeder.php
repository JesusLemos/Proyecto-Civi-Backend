<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SolicitudsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estados = ['Aceptado', 'Pendiente', 'Rechazado'];
        for ($i = 0; $i < 10; $i++) {
            DB::table('solicitudes')->insert([
                'id_usuario' => rand(1, 10),
                'id_oferta_trabajo' =>  rand(1, 10),
                'estado' => $estados[rand(0, 2)]
            ]);
        }
    }
}

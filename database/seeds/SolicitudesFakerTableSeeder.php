<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

class SolicitudesFakerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numFijo=true;
        $faker = Faker::create('es_ES');
        $estados = ['Aceptado', 'Pendiente', 'Rechazado'];
        foreach (range(1, 20) as $index) {
            DB::table('solicitudes')->insert([
                'id_usuario' => $faker->numberBetween($min = 1, $max = 10),
                'id_oferta_trabajo' =>  $faker->numberBetween($min = 1, $max = 10),
                'estado' => $estados[$faker->numberBetween($min = 0, $max = 2)],
                'visible_usuario'=>$numFijo,
                'visible_empresa'=>$numFijo
            ]);
        }
    }
}

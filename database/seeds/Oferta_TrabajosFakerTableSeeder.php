<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

class Oferta_TrabajosFakerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numFijo = true;
        $faker = Faker::create('es_ESz');
        foreach (range(1, 20) as $index) {
            DB::table('oferta_trabajos')->insert([
                'titulo' => $faker->sentence($nbWords = 3, $variableNbWords = true),
                'descripcion_oferta' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'popularidad' => $faker->numberBetween($min = 0, $max = 100),
                'anuncio' => $faker->numberBetween($min = 0, $max = 1),
                'id_empresa' => $faker->numberBetween($min = 1, $max = 10),
                'id_categoria' =>  $faker->numberBetween($min = 1, $max = 10),
                'id_ciudad' =>  $faker->numberBetween($min = 1, $max = 10),
                'fecha_publicacion' => $faker->dateTimeBetween($startDate = '-34 years', $endDate = 'now', $timezone = null),
                'salario' => $faker->numberBetween($min = 1000, $max = 9000),
                'visible_usuario' => $numFijo,
                'visible_empresa' => $numFijo
            ]);
        }
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

class EmpresasFakerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('es_ES');
        foreach (range(1, 20) as $index) {
            DB::table('empresas')->insert([
                'nif' => $faker->dni,
                'foto' => $faker->imageUrl($width = 640, $height = 480),
                'email' => $faker->freeEmail,
                'contrasenia' => $faker->password,
                'nombre_empresa' => $faker->company,
                'descripcion_empresa' => $faker->bs,
                'id_categoria' => $faker->numberBetween($min = 1, $max = 10),
                'remember_token' => bcrypt('123456')
            ]);
        }
    }
}

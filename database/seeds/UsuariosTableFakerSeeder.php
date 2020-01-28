<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

class UsuariosTableFakerSeeder extends Seeder
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
            DB::table('usuarios')->insert([
                'nombre_usuario' => $faker->firstName,
                'apellido' => $faker->lastName,
                'email' => $faker->freeEmail,
                'contrasenia' => $faker->password,
                'dni' => $faker->dni,
                'descripcion' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'telefono' => $faker->mobileNumber,
                'foto' => $faker->imageUrl($width = 640, $height = 480),
                'direccion' => $faker->address,
                'fecha_nacimiento' => $faker->dateTimeThisCentury->format('Y-m-d'),
                'remember_token' => bcrypt('123456')
            ]);
        }
    }
}

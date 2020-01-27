<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            DB::table('usuarios')->insert([
                'nombre_usuario' => Str::random(10),
                'apellido' => Str::random(15),
                'dni' => rand(10000000, 999999999),
                'descripcion' => Str::random(25),
                'telefono' => rand(00000000, 999999999),
                'foto' => Str::random(10),
                'direccion' => Str::random(30),
                'fecha_nacimiento' => date('Y-m-d'),
                'remember_token' => bcrypt('123456')
            ]);
        }
    }
}

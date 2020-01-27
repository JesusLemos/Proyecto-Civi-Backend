<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpresasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            DB::table('empresas')->insert([
                'nif' => rand(10000000, 999999999),
                'foto' => Str::random(10),
                'nombre_empresa' => Str::random(10),
                'descripcion_empresa' => Str::random(25),
                'id_categoria' => rand(1, 10),
                'remember_token' => bcrypt('123456')
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('cursos')->insert([
                'nome' => Str::random(15),
                'sigla' => Str::random(15),
                'tempo' => rand(15,90),
                'eixo_id' => $i,

            ]);
        }
    }
}

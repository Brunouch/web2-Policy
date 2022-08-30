<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class DisciplinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('disciplinas')->insert([
                'nome' => Str::random(15),
                'carga' => rand(20, 100),
                'curso_id' => $i,
            ]);
        }
    }
}

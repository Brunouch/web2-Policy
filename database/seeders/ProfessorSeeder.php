<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProfessorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 1; $i <= 10; $i++) {
            DB::table('professors')->insert([
                'nome' => Str::random(15),
                'email' => Str::random(15).'@gmail.com',
                'siape' => rand(1, 100),
                'ativo' => 1,
                'eixo_id' => $i,
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('users')->insert([
                'name' => 'Professor1',
                'email' => 'professor1@gmail.com',
                'password' => Hash::make('professor123'),
                'role_id' => 1,
            ]);
            
            DB::table('users')->insert([
                'name' => 'Coordenador1',
                'email' => 'coordenador1@gmail.com',
                'password' => Hash::make('coordenador123'),
                'role_id' => 2,
            ]);

            DB::table('users')->insert([
                'name' => 'Diretor1',
                'email' => 'diretor1@gmail.com',
                'password' => Hash::make('diretor123'),
                'role_id' => 3,
            ]);
    }
}

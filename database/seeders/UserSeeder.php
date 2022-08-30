<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
                'name' => 'RENAN LUIZ MACEDO',
                'email' => 'renanluizmacedo@hotmail.com',
                'password' => 'renan123',
                'role_id' => 1,
            ]);
        
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name_role = ['Coordenador','Diretor','Professor'];

        foreach($name_role as $name){
            DB::table('roles')->insert([
                'name' => $name,
            ]);
        }

    }
}

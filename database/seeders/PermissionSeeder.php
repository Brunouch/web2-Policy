<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 3; $i++) {
            for ($j = 1; $j <= 25; $j++) {

                DB::table('permissions')->insert([
                    'resource_id' => $j,
                    'role_id' => $i,
                    'permissao' => 1,
                ]);
            }
        }
    }
}

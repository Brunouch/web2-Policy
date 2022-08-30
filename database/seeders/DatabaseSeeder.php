<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $this->call(EixoSeeder::class);
    $this->call(CursoSeeder::class);
    $this->call(ProfessorSeeder::class);
    $this->call(AlunoSeeder::class);
    $this->call(DisciplinaSeeder::class);
    $this->call(ResourcesSeeder::class);
    $this->call(RoleSeeder::class);
    $this->call(UserSeeder::class);
    $this->call(PermissionSeeder::class);
  }
}

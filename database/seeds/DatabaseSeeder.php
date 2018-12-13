<?php

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
        $this->call(CriteriaMandatoryTableSeeder::class);
        $this->call(CriteriaSelfRegisTableSeeder::class);
        $this->call(FacultiesTableSeeder::class);
        $this->call(ClassRoomsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(StudentsTableSeeder::class);
        $this->call(UpdateFacClaTableSeeder::class);
    }
}

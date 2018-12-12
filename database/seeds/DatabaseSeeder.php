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
<<<<<<< HEAD
        //$this->call(RolesTableSeeder::class);
        //$this->call(UsersTableSeeder::class);
        //$this->call(FacultiesTableSeeder::class);
=======
        $this->call(CriteriaMandatoryTableSeeder::class);
        $this->call(CriteriaSelfRegisTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(FacultiesTableSeeder::class);
>>>>>>> 25dd129c583280bf440d40282f7b92c14c5dc5b0
        $this->call(ClassRoomsTableSeeder::class);
        $this->call(StudentsTableSeeder::class);
    }
}

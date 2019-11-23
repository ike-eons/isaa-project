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
        // $this->call(UsersTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(DepartmentsTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(SubjectsTableSeeder::class);
        $this->call(StudentsTableSeeder::class);
        $this->call(ClearanceValidatorTableSeeder::class);
    }
}
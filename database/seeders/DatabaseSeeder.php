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
        $this->call(UserSeeder::class);
        $this->call(UniversitySeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(SubjectSeeder::class);
    }
}

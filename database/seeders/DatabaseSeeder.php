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
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            CabinetSeeder::class,
            ColorSeeder::class,
            SubjectSeeder::class,
            MotifSeeder::class,
            ManutypeSeeder::class,
            AuthorSeeder::class,
            TranscriberSeeder::class,
        ]);
    }
}
<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        DB::statement('DELETE FROM users');
        DB::statement('DELETE FROM sportolas');
        DB::statement('DELETE FROM sports');
        DB::statement('DELETE FROM diaks');
        DB::statement('DELETE FROM osztalies');

        $this->call([
            UserSeeder::class,
            SportSeeder::class,
            OsztalySeeder::class,
            DiakSeeder::class,
            SportolasSeeder::class,
        ]);
    }
}

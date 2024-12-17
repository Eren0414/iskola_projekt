<?php

namespace Database\Seeders;

use App\Models\Diak;
use App\Models\Osztaly;
use App\Models\Sport;
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

        // if (User::count() === 0) {
        //     # code...
        //     User::factory()->create([
        //         'name' => 'test',
        //         'email' => 'test@example.com',
        //         'password' => '123',
        //     ]);
        // }

        //Csak sql szintaktikával hajlandó törölni
        DB::statement('DELETE FROM sportolas');
        DB::statement('DELETE FROM diaks');
        DB::statement('DELETE FROM osztalies');
        DB::statement('DELETE FROM sports');

        $this->call([
            UserSeeder::class,
            SportSeeder::class,
            OsztalySeeder::class,
            DiakSeeder::class,
            SportolasSeeder::class,
            // ... (más seederek)
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Sport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sportokData = [
            ['id' => 1, 'sportNev' => 'Labdarúgás'],
            ['id' => 2, 'sportNev' => 'Tenisz'],
            ['id' => 3, 'sportNev' => 'Sakk'],
            ['id' => 4, 'sportNev' => 'Lovaglás'],
            ['id' => 5, 'sportNev' => 'Sakk'],
            ['id' => 6, 'sportNev' => 'Kézilabda'],
            ['id' => 7, 'sportNev' => 'Lábtoll-labda'],
            ['id' => 8, 'sportNev' => 'Röplabda'],
            ['id' => 9, 'sportNev' => 'Cselgáncs'],
        ];
    
        if (Sport::count() === 0) {
            Sport::factory()->createMany($sportokData);
        }
    }
}

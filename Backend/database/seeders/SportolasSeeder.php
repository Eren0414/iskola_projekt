<?php

namespace Database\Seeders;

use App\Models\Sportolas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SportolasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['diakokId' => 2, 'sportokId' => 2],
            ['diakokId' => 2, 'sportokId' => 5],
            ['diakokId' => 4, 'sportokId' => 1],
            ['diakokId' => 6, 'sportokId' => 1],
            ['diakokId' => 6, 'sportokId' => 4],
            ['diakokId' => 6, 'sportokId' => 5],
        ];

        if (Sportolas::count() === 0) {
            Sportolas::factory()->createMany($data);
        }
    }
}

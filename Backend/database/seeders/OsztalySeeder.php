<?php

namespace Database\Seeders;

use App\Models\Osztaly;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OsztalySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $data = [
        //     ['id' => 1, 'osztalyNev' => '1.a'],
        //     ['id' => 2, 'osztalyNev' => '1.b'],
        //     ['id' => 3, 'osztalyNev' => '1.c'],
        //     ['id' => 4, 'osztalyNev' => '1.d'],
        //     ['id' => 5, 'osztalyNev' => '2.a'],
        //     ['id' => 6, 'osztalyNev' => '2.b'],
        //     ['id' => 7, 'osztalyNev' => '2.c'],
        //     ['id' => 8, 'osztalyNev' => '2.d'],
        // ];

        $filePath = database_path('csv\osztalies.csv');

        // Adatok beolvasása a CSV fájlból
        $data = [];
        if (($handle = fopen($filePath, "r")) !== FALSE) {
            while (($row = fgetcsv($handle, 1000, ";")) !== FALSE) {
                $data[] = [
                    'id' => $row[0],
                    'osztalyNev' => $row[1],
                ];
            }
            fclose($handle);
        }


        if (Osztaly::count() === 0) {
            Osztaly::factory()->createMany($data);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Diak;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [
            ['id' => 1, 'osztalyId' => 1, 'nev' => 'Rudi', 'neme' => true, 'szuletett' => '2018-01-12', 'helyseg' => 'Szolnok', 'osztondij' => 5000,  'atlag' => 3.5],
            ['id' => 2, 'osztalyId' => 1, 'nev' => 'Péter', 'neme' => true, 'szuletett' => '2018-03-02', 'helyseg' => 'Szolnok', 'osztondij' => 5000,  'atlag' => 3.7],
            ['id' => 3, 'osztalyId' => 1, 'nev' => 'Béla', 'neme' => true, 'szuletett' => '2017-06-24', 'helyseg' => 'Abony', 'osztondij' => 5000,  'atlag' => 4.5],
            ['id' => 4, 'osztalyId' => 1, 'nev' => 'Enikő', 'neme' => false, 'szuletett' => '2016-05-17', 'helyseg' => 'Szolnok', 'osztondij' => 5000,  'atlag' => 3.9],
            ['id' => 5, 'osztalyId' => 1, 'nev' => 'Ágnes', 'neme' => false, 'szuletett' => '2018-04-22', 'helyseg' => 'Abony', 'osztondij' => 5000,  'atlag' => 4.7],
            ['id' => 6, 'osztalyId' => 1, 'nev' => 'Anikó', 'neme' => false, 'szuletett' => '2018-11-02', 'helyseg' => 'Szolnok', 'osztondij' => 5000,  'atlag' => 3.1],
            ['id' => 7, 'osztalyId' => 1, 'nev' => 'Feri', 'neme' => true, 'szuletett' => '2018-03-21', 'helyseg' => 'Abony', 'osztondij' => 5000,  'atlag' => 3.6],
        ];

        if (Diak::count() === 0) {
            Diak::factory()->createMany($data);
        }
    }
}

<?php

namespace Tests\Feature;

use App\Models\Sport;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SportsTest extends TestCase
{

    use DatabaseTransactions;

    public function test_the_get_sports_tabla_all_record_example(): void
    {
        $row=Sport::create([
            'sportNev' => 'xxx'
        ]);

        $response = $this->get('/api/sports');
        //A táblába bekerült a rekord
        $response -> assertSee('xxx');
        $response->assertStatus(200);

        //A táblában vannak rekordok
        // $response->assertStatus(200)
        // ->assertJsonStructure([
        //     'message' => 'string', // Ellenőrizzük a "message" kulcsot is
        //     'data' => [
        //         '*' => [
        //             'id' => 'integer',
        //             'sportNev' => 'string',
        //         ],
        //     ],
        // ]); // Az '*' azt jelenti, hogy tetszőleges számú elem lehet
        // ->assertJsonCount(1, 'data'); // Ellenőrizzük, hogy két felhasználó van

        $this->assertDatabaseHas('sports', ['id' => 1]); // Ellenőrizzük, hogy az adatbázisban is létezik az első felhasználó
    }
}

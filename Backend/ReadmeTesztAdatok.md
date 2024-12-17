# Teszt adatok létrehozása

## Model fájlok

Minden táblához egy modell-t kell létrehozni:

-   A model egy osztály
-   ami a tábla objektum szintű megvalósítása.
-   Ebben az osztályban szabályozhatjuk, hogy:
    -   mely oszlopok tölthetők fel (**fillable**).
    -   mely oszlopok ne legyenek visszaadva a JSON válaszban (**hidden**).
    -   bizonyos oszlopok milyen típusra legyenek kasztolva (**cast**).

## Sportok tesz tadatok

Hogy teszt adatokat és endpointokat hozzunk létre a kövtekezőket kell tenni:

1. Létre kell hozni a táblához egy **modell**-t

-   `php artisan make:model Sport`
    -   A model nevét írjuk mindig nagybetűvel (ez lesz az osztály neve)
    -   make model helpjének lekérdezése: `php artisan make:model -h`
    -   A model fájl: app/Models/Sportok.php

2. A **database/seeders/DatabaseSeeder.php** fájl
   Ebben a fájlban lehet különböző módon teszt adatokat definiálni 
   - Vagy úgy hogy kézzel, 
   - Vagy úgy, hogy cilkussal véletlenszerű adatokat generálunk 
   - Érdemes az adott tábla Seeder osztályában definiálni a teszt adatok generálását 
   - Létrejött a: **database/seeders/SportSeeder.php**

**database/seeders/SportSeeder.php**: 
```php
public function run(): void
{
    // sportok tábla adatai
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
```
A **database/seeders/DatabaseSeeder.php**-ből hívjuk az összes tábla seederét
```php
public function run(): void
{
    //A call(...) függvény nem php, hanem kimondottan laravel specifikus függvény
    //A seedererre lett kidolgozva. A paramétergyűjteményében megadott osztályok
    // run() metódusait hívja.
    $this->call([
        SportSeeder::class,
        // ... (más seederek)
    ]);
}
```

`php artisan db:seed`

csak a sport seeder futtatása:
`php artisan db:seed --class=SportSeeder`

A sport seeder futtatása a központi seederből:

```php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function  
    run()
    {
        // ... (más seederek meghívása)

        $this->call([
            SportSeeder::class,
            // ... (más seederek)
        ]);
    }
}
```

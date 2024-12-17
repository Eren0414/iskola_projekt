# Alapfogalmak
## Feature Teszt
Feature teszt alatt azt értjük, hogy **az alkalmazásunk egy adott funkcióját**, vagyis egy feature-jét egészében teszteljük. Ez azt jelenti, hogy nem csak egyetlen osztály vagy függvény működését vizsgáljuk, hanem azt, hogy az adott funkció hogyan viselkedik, amikor az alkalmazás többi részével együttműködik.

A Laravelben a feature tesztek írásához általában a *tests/Feature* könyvtárat használjuk. A tesztekben HTTP kéréseket szimulálunk, és ellenőrizzük a válaszokat. A PHPUnit keretrendszer segítségével írhatunk olyan teszteket, amelyek az egész alkalmazásunkat lefedik.

## Unit teszt
Az egységteszt (unit test) a szoftverfejlesztés egyik alapvető eszköze, melynek célja, hogy egy adott kódrészlet (egység) helyes működését ellenőrizze. Ez az egység lehet egy függvény, egy osztály vagy egy kis modul.

## Smoke tesztek
A smoke teszt egy olyan tesztelési módszer a szoftverfejlesztésben, amelynek célja, hogy gyorsan és egyszerűen megállapítsa, egy új vagy módosított szoftververzió alapvető funkciói működnek-e megfelelően. Gyakran nevezik sanity testingnek vagy build verification testnek is.

A smoke teszt az első lépcsőfok a szoftver tesztelésében. Ha a smoke teszt sikeres, akkor a fejlesztők és a tesztelők biztosak lehetnek abban, hogy a szoftver alapvető funkciói működnek, és a további tesztelésre érdemes időt fordítani.

# Teszt adatbázis környezet.
## phpunit.xml
Itt van definiálva többek közt:
- a teszt fájlok helye, 
    - <directory>tests/Unit</directory>
    - <directory>tests/Feature</directory>
- melyik env fájl legyen a teszthez használva: 
    - <env name="APP_ENV" value="testing"/>
```xml
<?xml version="1.0" encoding="UTF-8"?>
<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:noNamespaceSchemaLocation="vendor/phpunit/phpunit/phpunit.xsd"
         bootstrap="vendor/autoload.php"
         colors="true"
>
    <testsuites>
        <testsuite name="Unit">
            <directory>tests/Unit</directory>
        </testsuite>
        <testsuite name="Feature">
            <directory>tests/Feature</directory>
        </testsuite>
    </testsuites>
    <source>
        <include>
            <directory>app</directory>
        </include>
    </source>
    <php>
        <env name="APP_ENV" value="testing"/>
        <env name="APP_MAINTENANCE_DRIVER" value="file"/>
        <env name="BCRYPT_ROUNDS" value="4"/>
        <env name="CACHE_STORE" value="array"/>
        <env name="DB_CONNECTION" value="mysql"/>
        <env name="DB_DATABASE" value="database/test.sqlite"/>
        <env name="DB_DATABASE" value=":memory"/>
        <env name="MAIL_MAILER" value="array"/>
        <env name="PULSE_ENABLED" value="false"/>
        <env name="QUEUE_CONNECTION" value="sync"/>
        <env name="SESSION_DRIVER" value="array"/>
        <env name="TELESCOPE_ENABLED" value="false"/>
    </php>
</phpunit>
```

## .env.testing
A tesztek ezeket a beállításokat tartalmazzák
A helyes szemlélet az, hogy a teszthez egy másik adatbázist használunk
A legjobb az, ha a memódiában legyen az adatbázis: **sqlight**
```env
DB_CONNECTION=sqlite
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database/test.sqlite
DB_USERNAME=
DB_PASSWORD=
```


# Teszt indítása
A tesztek az alkalmazás **tests/Feature**, és a **tests/Unit** mapáiban vannak.
Példa: tests/Feature/ExampleTest.php
```php
public function test_the_api_returns_a_successful_response(): void
{
    $response = $this->get('/api');
    //A válasz tartalmazza-e az API szót?
    $response->assertSee('API');
    //A válasz státusza 200-e?
    $response->assertStatus(200);
}
```
Teszt indítása: `php artisan test`
Egy adott Teszt függvény futtatása: `php artisan test --filter test_the_api_returns_a_successful_response`
Egy adott teszt osztály (UserTest.php) futtatása: `php artisan test --filter UserTest`

## Feature teszt generálása
`php artisan make:test SportsTest`







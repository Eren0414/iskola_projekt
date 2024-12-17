# Projekt létrehozása
- Laravel projekt létrehozása: `composer create-project laravel/laravel laravel-iskola`
    - A létrejövő `laravel-iskola` mappában kell dolgoznunk.

# Adatbázis

## 1. **Adatbázis létrehozás** (forge)
```sql
CREATE DATABASE `laravel-iskola`
	CHARACTER SET utf8
	COLLATE utf8_hungarian_ci;
```

## 2. **Kapcsolódás** az adatbázishoz
A Laravel [nagyon sok adatbázist](https://g.co/gemini/share/2cfbf84b5af8) tud kezelni.
Az **.env** fájlban konfiguráljuk az adatbázishoz csatlakozást
```.env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel-iskola
DB_USERNAME=root
DB_PASSWORD=
```

# REST API
## Mi a REST API
Az REST API feladata, hogy az adatbázist, mint erőforrást képes számunkra kiszolgálni.
    - **CRUD** műveleteket tudunk rajta végrehatani.
    - Az API végpontokat (**endpoinok**) hoz létre, amik megfelelő metódusú (GET, POST stb.) url kérésekkel enged hozzáférni
    - A rendszer lehetővé teszi a jogosultság kezelést például tokenes hitelesítés segítségével.

## Az **api telepítése**
Ahhoz, hogy a Laravellel API-t tudjunk építeni telepíteni kell:
- Telepítési parancs: `php artisan install:api`
    - A végén kérdezi, hogy letelepítse-e a táblákat: Enter (yes)


## A REST API felépítése a Laravel-ben
A Laravel-el táblánként (lekérdezésenként), rendkívül rugalmasan és modulárisan tudjuk kiépíteni az API endpointokat. Ezek alapvető elemei (ezek fájlokban lévő, többnyire automatikusan generált osztályok):
- **Migrációs fájlok**: Ezzel táblákat, kapcsolatokat, indexeket hozhatunk létre
    - Helye: **app/database/migrations**
- **Seeder**: Egy olyan rendszer, amivel teszt adatokat tudunk programból generálni.
    - Helye: **app/database/seeders**
- **Modellek** (adat logika): Osztályok, amikkel a táblákat objektum orientált programozással kezelhetjük adatbázis fajtától függetlenül azonos utasításkésszlettel.
    - Helye: **app/Models**
- **Kontrollerek** (üzleti logika): Osztályok, amikben az a kód található, mik megvalósítják a táblákhoz való megfelelő hozzáférést.
    - Helye: **app/Http/Controllers**
- Endpoint létrehozása: route - metódus - működés összekötés:
    - Helye: **app/routes/api.php**


## Az API tesztelése
api teszt endpoint létrehozás: **routes/api.php**
```php
//teszt: /api/ útvonalra
Route::get('/', function(){
    return 'API';
});
```

- Laravel szerver indítás: `php artisan serve`

### Tesztelő eszköz: 
**request.rest** létrehozása, / útvonal kipróbálása

## Sport API felépítése

Felépítjük a sport API-t: `php artisan make:model Sport -a --api`
Ez létrehozza:
- **Migrációs fájlt**
    - database\migrations/2024_11_18_070825_create_sports_table.php
- **Modelt**: 
    - app\Models\Sport.php
- **Senders**-t (teszt adatok létrehozása)
    - database\seeders\SportSeeder.php
    - database\factories\SportFactory.php
- **Konkrolert**: 
    - app\Http\Controllers\SportController.php
    - Adat validáció:
        - app\Http\Requests\StoreSportRequest.php
        - app\Http\Requests\UpdateSportRequest.php
    - Felhasználói jogosultságok:
        - app\Policies\SportPolicy.php

### Sport tábla létrehozása migrációval
A migráció azt jelenti, hogy Laravel-ből hozzuk létre a táblát
Migrációs fájlt ezel a pranccsal is létrehozhattuk volna: `php artisan make:migration create_sports_table`
A feladatok: 
1. Keressük meg a **sports** tábla migrációs fájlját: **database/2024_11_18_070825_create_sports_table.php.php**

2. Tervezzük meg a tábla szerkezetét a migrációs fájlban
[legfontosabb laravel adattípusok](https://g.co/gemini/share/f42e5d0d98a3)
[Migráció buttterscmd.com](https://buttercms.com/blog/laravel-migrations-ultimate-guide/)
```php
public function up(): void
{
    Schema::create('sportok', function (Blueprint $table) {
        $table->Integer('id')->unsigned()->autoIncrement();
        $table->string('sportNev', 50)->notNull();
        //Nem akarjuk, hogy a laravel ebben a fájlban naplózza, mikor hoztunk létre egy sportot
        // $table->timestamps();
    });
}
```

3. Adjuk ki azt a parancsot, ami a migrációs fájl alapján létrehozza a táblát: 
    - `php artisan migrate`
    - A tábla létrejön az adatbázisban.
    - Elenőrizzük, és ha nem jó, [visszavonhatjuk a migrációt többféleképpen](https://g.co/gemini/share/920d760d26ba):
        - Legutóbbi migráció visszavonása: `php artisan migrate:rollback`
        - Legutóbbi három migráció visszavonása: `php artisan migrate:rollback --steps=3`
        - Adott migrációs fájl visszavonása: `php artisan migrate:rollback create_sportok_table`
    - Javítjuk, újra migráljuk

4. Az eddigi migrációk lekédezhetők: 
    - `php artisan migrate:status`

### Sport tábla modell
Helye: **app\Models\Sport.php**
```php
class Sport extends Model
{
    /** @use HasFactory<\Database\Factories\SportFactory> */
    use HasFactory, Notifiable;
    
    //Ne foglalkozzon a timestamps mezőkkel
    public $timestamps = false;
    
    //Ezeket a mezőket lehet feltölteni
    protected $fillable = [
        'id',
        'sportNev',
    ];
}
```

### Sport tábla feltöltése teszt adatokkal
A teszt adatokat a **seederekkel** lehet generálni.

1. A **database/seeders/DatabaseSeeder.php** fájl
   Ebben a fájlban lehet különböző módon teszt adatokat definiálni 
   - Vagy úgy hogy kézzel, 
   - Vagy úgy, hogy cilkussal véletlenszerű adatokat generálunk 
   - Érdemes az adott tábla Seeder osztályában definiálni a teszt adatok generálását 
   - Létrejött a: **database/seeders/SportSeeder.php**

2. Írjuk meg az adatgenerálás kódját
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
3. Illesszük be a **DatabaseSeeder.php**-be

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
Futtassuk a seedert:
- `php artisan db:seed`
- Az adatok generálódnak a sports táblában
- Akárhányszor lefuttathatjuk, mivel coutn-al levédtük
- Csak a **SportSeeder.php** futtatása is lehetséges: `php artisan db:seed --class=SportSeeder`
    - Megkerüljük a **DatabaseSeeder.php**-t

### Sport tábla CRUD kontroller
Helye: **app\Http\Controllers\SportController.php**

1. GET sports konroller (kiolvassuk s sports tábla sorait)
```php
class SportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Sport::all();
        return response()->json(['products' => $products], options: JSON_UNESCAPED_UNICODE);
    }
}
```

### sports Get endpoint létrehozása
Célja, hogy létrehozzuk az **method - url - get kontroller** (index()) láncot.

1. Létrehozzuk az **endpointot**
Helye: **app/routes/api.php**
```php
use App\Http\Controllers\SportController;
//...
//A Get .../sports kérésre fusson le a SportController osztály index() metódusa
Route::get('sports', [SportController::class, 'index']);
//...
```

Teszteljük az endpointot a **request.rest**-el


### rout-ok lekérdezése
`php artisan route:list`






### Osztályok tábla
- `php artisan make:migration create_osztalyok_table`
```php
public function up(): void
{
    Schema::create('osztalyok', function (Blueprint $table) {
        $table->Integer('id')->unsigned()->autoIncrement();
        $table->string('osztalyNev', 50)->notNull();
    });
}
```
- `php artisan migrate`


### Diakok tábla
- `php artisan make:migration create_diakok_table`
```php
public function up(): void
{
    Schema::create('diakok', function (Blueprint $table) {
        $table->Integer('id')->unsigned()->autoIncrement();
        $table->Integer('osztalyId')->unsigned();
        $table->foreign('osztalyId')->references('id')->on('osztalyok'); //Idegen kulcs
        $table->string('nev', 50)->notNull();
        $table->boolean('neme')->default(true);
        $table->date('szuletett')->nullable();
        $table->string('helyseg', 50)->nullable();
        $table->decimal('osztondij', 10,2)->nullable();
        $table->float('atlag')->nullable();
        $table->timestamps();
    });
}
```
- `php artisan migrate`

#### Migrációk lekérdezése
`php artisan migrate:status`

#### Diákok tábla módosítása (migrációval)
1. **új mező** utólag (hozzárakunk egy akarmi nevű string mezőt)
Hozzunk létre egy új migrációs fájlt: php artisan `php artisan make:migration add_akarmi_to_diakok --table=diakok`
- Létrejön az új migrációs fájl: **2024_11_17_155401_add_akarmi_to_diakok.php**
- Figyeljük meg, hogy most az up metódusban **create** helyett **table** van!
```php
public function up(): void
{
    Schema::table('diakok', function (Blueprint $table) {
        $table->string('akarmi', 50)->nullable(true);
    });
}
```
- Migráljunk: - `php artisan migrate`

2. **mező átnevezés**
- Átnevezés: **akarmi** -> **akarmiUj** névre
- Új migrációs fájl: `php artisan make:migration rename_akarmi_to_diakok --table=diakok`
- Új fájl: **2024_11_17_160536_rename_akarmi_to_diakok.php**
```php
    public function up(): void
    {
        Schema::table('diakok', function (Blueprint $table) {
            $table->renameColumn('akarmi', 'akarmiUj');
        });
    }
```
- Migráljunk: - `php artisan migrate`

3. mező **tulajdonság megváltoztatása**
- Mezőhossz: **akarmi** 50 -> 75
- Új migrációs fájl: `php artisan make:migration resize_akarmi_to_diakok --table=diakok`
- Új fájl: **2024_11_17_160536_resize_akarmi_to_diakok.php**
```php
    public function up(): void
    {
        Schema::table('diakok', function (Blueprint $table) {
            $table->string('akarmiUj', 75)->change();
        });
    }
```
- Migráljunk: - `php artisan migrate`

4. mező törlése
- Mező törlése: **akarmi**
- Új migrációs fájl: `php artisan make:migration delete_akarmi_to_diakok --table=diakok`
- Új fájl: **2024_11_17_160536_resize_akarmi_to_diakok.php**
```php
    public function up(): void
    {
        Schema::table('diakok', function (Blueprint $table) {
            $table->dropColumn('akarmiUj');
        });
    }
```
- Migráljunk: - `php artisan migrate`

#### sportolas tábla létrehozása
### Diakok tábla
- `php artisan make:migration create_sportolas_table`
```php
 public function up(): void
{
    Schema::create('sportolas', function (Blueprint $table) {
        $table->Integer('diakokId')->unsigned();
        $table->Integer('sportokId')->unsigned();
        $table->foreign('diakokId')->references('id')->on('diakok');
        $table->foreign('sportokId')->references('id')->on('sportok');
        $table->primary(['diakokId', 'sportokId']);
        $table->timestamps();
    });
}
```
- `php artisan migrate`

# CRUD
## Model fájl
Minden táblához egy modell-t kell létrehozni:
- A model egy osztály
- ami a tábla objektum szintű megvalósítása. 
- Ebben az osztályban szabályozhatjuk, hogy:
    - mely oszlopok tölthetők fel (**fillable**).
    - mely oszlopok ne legyenek visszaadva a JSON válaszban (**hidden**).
    - bizonyos oszlopok milyen típusra legyenek kasztolva (**cast**).

1. **Modell** létrehozása
- `php artisan make:model Sport`
    - A model nevét írjuk mindig egyes számban és nagybetűvel (ez lesz az osztály neve)
    - make model helpjének lekérdezése: `php artisan make:model -h`
    - A model fájl: **app/Models/Sport.php**

```php
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Sport extends Model
{
    use HasFactory, Notifiable;
    //Ezeket lehet feltölteni
    protected $fillable = [
        'sportNev',
    ];
}
```




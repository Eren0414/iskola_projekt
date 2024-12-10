# Parancok öszefoglaló
- Laravel REST API projekt létrehozás
    - `composer create-project laravel/laravel laravel-iskola`
    - `php artisan install:api`

- Adatbázis létrehozás konfigurálás
```sql
CREATE DATABASE `laravel-iskola`
	CHARACTER SET utf8
	COLLATE utf8_hungarian_ci;
```
**.env**
```.env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel-iskola
DB_USERNAME=root
DB_PASSWORD=
```

- **Szerver indít**:  `php artisan serve`

- Egy tábla (Diak) CRUD létrehozás
    - **API generálás**: `php artisan make:model Diak -a --api` -
    - **Migráló parancs**: `php artisan migrate`
        -   Ellenőrzés, esetleges vissazvonás, javítás
        -   Legutóbbi migráció visszavonása: `php artisan migrate:rollback`
        -   Legutóbbi három migráció visszavonása: `php artisan migrate:rollback --steps=3`
        -   Adott migrációs fájl visszavonása: `php artisan migrate:rollback create_sportok_table`
        -   Az összes eddigi tábla törlése és a migrációk újrafuttatása: `php artisan migrate:refresh`
    -   Migrációk lekérdezése: `php artisan migrate:status`
- Seeder futtatás:  `php artisan db:seed`

- `php artisan make:controller UserController`

# Laravel projekt létrehozás

-   `composer create-project laravel/laravel laravel-iskola`
-   A `laravel-iskola` mappában kell dolgoznunk.
-   Laravel API telepítése: `php artisan install:api`

# Adatbázis

-   Adatbázis létrehozás (forge)

```sql
CREATE DATABASE `laravel-iskola`
	CHARACTER SET utf8
	COLLATE utf8_hungarian_ci;
```

-   Adatbázis konfigurálás: **.env**

```.env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel-iskola
DB_USERNAME=root
DB_PASSWORD=
```

# Szerver indítás, teszt


-   api endpoint teszt: **routes/api.php**

```php
//teszt: /api/ útvonalra
Route::get('/', function(){
    return 'API';
});
```

-   Laravel szerver indítás: `php artisan serve`

-   **request.rest** létrehozása, .../api/ útvonal kipróbálása

```rest
### változók
@protocol = http://
@hostname = localhost
@port = 8000
@host = {{protocol}}{{hostname}}:{{port}}

### teszt
get {{host}}/api/
```

# Egy tábla (diaks) CRUD endpoint létrehozás lépései

## API generálás

Tabla API generálás: `php artisan make:model Diak -a --api` - Fontos!!! Tábla neve **egyesszámban**, **Nagybetűvel** kezdve
### Ami létrejön
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


## Tábla készítés migrációval

### Szerkezet

-   Tábla szerkezetének kialakítása
-   Migrációs fájl: database\migrations/2024_11_18_070825_create_sports_table.php

```php
public function up(): void
{
    Schema::create('diaks', function (Blueprint $table) {
        $table->Integer('id')->unsigned()->autoIncrement();
        $table->Integer('osztalyId')->unsigned();
        $table->foreign('osztalyId')->references('id')->on('osztalies'); //Idegen kulcs
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

### Migrálás (tábla készítés)

-   Migráló parancs: `php artisan migrate`
    -   Ellenőrzés, esetleges vissazvonás, javítás
    -   Legutóbbi migráció visszavonása: `php artisan migrate:rollback`
    -   Legutóbbi három migráció visszavonása: `php artisan migrate:rollback --steps=3`
    -   Adott migrációs fájl visszavonása: `php artisan migrate:rollback create_sportok_table`
    -   Az összes eddigi tábla törlése és a migrációk újrafuttatása: `php artisan migrate:refresh`
-   Migrációk lekérdezése: `php artisan migrate:status`

## Model konfigurálás

Helye: **app\Models\Sport.php**

```php
class Diak extends Model
{
    /** @use HasFactory<\Database\Factories\DiakFactory> */
    use HasFactory, Notifiable;

    //Ha nem lennének tiestamps mezők
    //public $timestamps = false;

    protected $fillable = [
        'id',
        'osztalyId',
        'nev',
        'neme',
        'szuletett',
        'helyseg',
        'osztondij',
        'atlag',
    ];

    protected function casts(): array
    {
        return [
            'neme' => 'boolean',
            'szuletett' => 'date',
        ];
    }
}

```

## CRUD kontroller

Helye: **app\Http\Controllers\DiakController.php**

```php
    public function index()
    {
        $rows = Diak::all();
        // $rows = Diak::orderBy('nev', 'asc')->get();
        return response()->json(['rows' => $rows],
            options: JSON_UNESCAPED_UNICODE);
    }

    public function store(StoreDiakRequest $request)
    {
        $row = Diak::create($request->all());
        return response()->json(['row' => $row], 
            options: JSON_UNESCAPED_UNICODE);
    }

    public function show(int $id)
    {
        $row = Diak::find($id);
        if ($row) {
            $data = ['row' => $row];
        } else {
            $data = [
                'message' => 'Not found',
                'id' => $id
            ];
        }
        return response()->json($data, 
            options: JSON_UNESCAPED_UNICODE);
    }

    public function update(UpdateDiakRequest $request,  $id)
    {
        $row = Diak::find($id);
        if ($row) {
            $row->update($request->all());
            $data = ['row' => $row];
        } else {
            $data = [
                'message' => 'Not found',
                'id' => $id
            ];
        }
        return response()->json($data, 
            options: JSON_UNESCAPED_UNICODE);
    }

    public function destroy(int $id)
    {
        $row = Diak::find($id);
        if ($row) {
            $row->delete();
            $data = [
                'message' => 'Deleted successfully',
                'id' => $id
            ];
        } else {
            $data = [
                'message' => 'Not found',
                'id' => $id
            ];
        }
        return response()->json($data,
            options: JSON_UNESCAPED_UNICODE);
    }
```



## Validálás

-   Helye: **app/Http/Request** mappa, Update, Store fájlok

**app/Http/Request/StoreOsztalyRequest.php**

```php
class StoreDiakRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'osztalyId' => 'required|integer',
            'nev' => 'required|string|min:2',
            'neme' => 'required|boolean',
            'szuletett' => 'date',
            'helyseg' => 'string|min:2',
            'osztondij' => 'numeric',
            'atlag' => 'numeric',
        ];
    }
}
```

**app/Http/Request/UpdateOsztalyRequest.php**

```php
class UpdateDiakRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'osztalyId' => 'nullable|integer',
            'nev' => 'nullable|string|min:2',
            'neme' => 'nullable|boolean',
            'szuletett' => 'nullable|date',
            'helyseg' => 'nullable|string|min:2',
            'osztondij' => 'nullable|numeric',
            'atlag' => 'nullable|numeric',
        ];
    }
}
```

## Endpointok
- Helye: **routes/api.php**

```php
// Route::get('diaks', [DiakController::class, 'index']);
// Route::get('diaks/{id}', [DiakController::class, 'show']);
// Route::post('diaks', [DiakController::class, 'store']);
// Route::patch('diaks/{id}', [DiakController::class, 'update']);
// Route::delete('diaks/{id}', [DiakController::class, 'destroy']);

Route::apiResource('diaks', DiakController::class);
```
### rout-ok lekérdezése
`php artisan route:list`


# Teszt adatok

A külső táblákat érdemes teszt adatokkal feltölteni

## Például sport tábla feltöltése

1. **database/seeders/SportSeeder.php**

```php
public function run(): void
{
    $data = [
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
        Sport::factory()->createMany($data);
    }
}
```

csv fájlból is beolvashatunk (Ez egy osztály beolvasása):

```csv
1;1.a
2;1.b
3;1.c
4;1.d
5;2.a
6;2.b
7;2.c
8;2.d
```

```php
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

    //A laravel az app/database mappát veszi alapnak
    $filePath = database_path('csv/osztalies.csv');

    // Adatok beolvasása a CSV fájlból
    $data = [];
    if (($handle = fopen($filePath, "r")) !== FALSE) {
        while (($row = fgetcsv($handle, null, ";")) !== FALSE) {
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
```

```php
public function run(): void
{
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
```

2. **database/seeders/DatabaseSeeder.php**

```php
public function run(): void
{
    DB::statement('DELETE FROM diaks');
    DB::statement('DELETE FROM osztalies');
    DB::statement('DELETE FROM sports');

    $this->call([
        SportSeeder::class,
        OsztalySeeder::class,
        DiakSeeder::class,
        // ... (más seederek)
    ]);
}
```

3. seederek futtatása: `php artisan db:seed`


# Cors kezelés
[cors (gemini)](https://g.co/gemini/share/477e6307e707)
A CORS egy olyan biztonsági mechanizmus, amely lehetővé teszi, hogy különböző domain-ekről származó weboldalak egymás erőforrásait hozzáférjék. Ez azért fontos, mert a böngészők alapértelmezett beállítása szerint csak az azonos domainről származó kéréseket engedélyezik. 
Ha ezt nem állítanánk be, a kliens oldal nem férne hozzá az API erőforrásaihoz.
A cors beállítások a http kérésre adott válasz fejlécében érkeznek, és ennek alapján befolyásolja a böngésző működését.

- A cors beállítás létrehozása: `php artisan config:publish cors`
- Létrejön egy **app/config/cors.php** fájl. Itt állíthatjuk be, hogy milyen **metódusokat**, illetve milyen **doménról** szolgálhat ki az API

```php
return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    // 'allowed_methods' => ['*'],
    'allowed_methods' => ['OPTIONS','GET','POST','PATCH','DELETE'],

    //*: Ez a beállítás engedélyezi a CORS-t bármely domainről érkező kérésekhez.
    //A valóságban itt egy adott (egy-vagy több) domaint engedélyezünk.
    'allowed_origins' => ['*'],

    'allowed_origins_patterns' => [],

    //Mely fejlécek engedélyezettek a kérésekben
    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,
];    
```
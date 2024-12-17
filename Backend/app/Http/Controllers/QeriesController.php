<?php

namespace App\Http\Controllers;

use App\Models\Diak;
use App\Models\Osztaly;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QeriesController extends Controller
{
    public function queryOsztalynevsorok()
    {
        //natív SQL
        $rows =  DB::select(
            'SELECT  osztalyNev, nev FROM diaks d
                INNER JOIN osztalies o ON d.osztalyId = o.id
                ORDER BY osztalyNev, nev'
        );

        //DB facade
        // $rows = DB::table('diaks as d')
        //     ->join('osztalies as o', 'd.osztalyId', '=', 'o.id')
        //     ->select('osztalyNev', 'nev')
        //     ->orderBy('osztalyNev', 'asc')
        //     ->orderBy('nev', 'asc')
        //     ->get();

        //Eloquent
        // $rows = Diak::with('osztalies')
        //     // ->orderBy('osztalies.osztalyNev', 'asc')
        //     ->orderBy('nev', 'asc')
        //     ->get();

        //$rows = Osztaly::with('diakok');


        $data = [
            'message' => 'ok',
            'data' => $rows
        ];

        return response()->json($data, options: JSON_UNESCAPED_UNICODE);
    }

    public function queryOsztalynevsorLimit(int $oldal, int $limit){
        $offset = ($oldal - 1) *$limit;

        $query = 'SELECT  osztalyNev, nev from diaks d
            inner join osztalies o on d.osztalyId = o.id
            order by osztalyNev, nev
            limit ? offset ?
            ';
        $rows= DB::select($query, [$limit, $offset]);
        $data = [
            'message' => 'ok',
            'data' => $rows
        ];

        return response()->json($data, options:JSON_UNESCAPED_UNICODE);
    }

    public function queryHanyOldalVan(int $limit){
        

        $query = 'SELECT  count(*) db from diaks d
            inner join osztalies o on d.osztalyId = o.id
            ';
        $rows= DB::select($query);
        $db = $rows[0]->db;
        $oldalszam = ceil($db/$limit);
        $data = [
            'message' => 'ok',
            'data' => [
                'oldalszam' => $oldalszam
            ]
        ];

        return response()->json($data, options:JSON_UNESCAPED_UNICODE);
    }


    public function queryOsztalytasrsak(string $nev){
       
        $query = '
            select nev, osztalyId	from diaks
            where osztalyId =
                (
                select osztalyId
                    from diaks
                    where nev = ?
                ) and nev <> ?
            order by nev
            ';
        $rows= DB::select($query,[$nev, $nev]);
        $data = [
            'message' => 'ok',
            'data' => $rows
        ];

        return response()->json($data, options:JSON_UNESCAPED_UNICODE);
    }


    public function queryDiakKeres( $nev){


        //return response()->json($nev, options:JSON_UNESCAPED_UNICODE);


        //sql injection
        // $query = '
        //     SELECT id, osztalyId, nev,neme,szuletett,helyseg, osztondij, atlag from diaks 
        //     WHERE nev = "'.$nev.'" union select * from users#"';
        // $rows= DB::select($query);
        $query = '
            SELECT * from diaks 
            WHERE nev = "'.$nev.'"';
        $rows= DB::select($query);

        //no sql sinjection
        // $query = '
        //     SELECT id, osztalyId, nev,neme,szuletett,helyseg, osztondij, atlag from diaks 
        //     WHERE nev = ?';

        // $rows= DB::select($query, [$nev]);
        $data = [
            'message' => 'ok',
            'data' => $rows,
            'query' => $query
        ];

        return response()->json($data, options:JSON_UNESCAPED_UNICODE);
    }





}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueriesController extends Controller
{
    public function queryOsztalynevsor(){
        $query = 'SELECT  osztalyNev, nev from diaks d
            inner join osztalies o on d.osztalyId = o.id
            order by osztalyNev, nev';
        $rows= DB::select($query);
        $data = [
            'message' => 'ok',
            'data' => $rows
        ];

        return response()->json($data, options:JSON_UNESCAPED_UNICODE);
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
    
}

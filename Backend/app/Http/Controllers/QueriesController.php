<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueriesController extends Controller
{
    public function queryOsztalynevsor()
    {
        $query = 'SELECT  osztalyNev, nev from diaks d
            inner join osztalies o on d.osztalyId = o.id
            order by osztalyNev, nev';
        $rows = DB::select($query);
        $data = [
            'message' => 'ok',
            'data' => $rows
        ];

        return response()->json($data, options: JSON_UNESCAPED_UNICODE);
    }

    public function queryOsztalytarsak(string $nev)
    {
        $query = '
            select nev, osztalyId from diaks
            where osztalyId =
                (
                select osztalyId
                    from diaks
                    where nev = ?
                ) and nev<> ?
            order by nev
            ';
        $rows = DB::select($query, [$nev, $nev]);
        $data = [
            'message' => 'ok',
            'data' => $rows
        ];

        return response()->json($data, options: JSON_UNESCAPED_UNICODE);
    }

    public function queryOsztalyOldal(int $oldal, int $darab)
    {
        $offset = ($oldal - 1) * $darab;

        # Natív
        $rows = DB::select(
            'SELECT o.osztalyNev, d.nev FROM osztalies o
                        INNER JOIN diaks d ON d.osztalyId = o.id
                        LIMIT ? OFFSET ?',
            [$darab, $offset]
        );
        $data = [
            'message' => 'ok',
            'data' => $rows
        ];

        return response()->json($data, options: JSON_UNESCAPED_UNICODE);
        // $osszes = DB::select('SELECT COUNT(*) darab from osztalies');
        // $osszes = $osszes[0]->darab;

        // $osszesOldal = ceil($osszes / $darab);

        // if (!($oldal > $osszesOldal || $oldal < 1)) {
        //     $data = [
        //         'message' => 'ok',
        //         'oldal' => "{$oldal}|{$osszesOldal}",
        //         'data' => $rows
        //     ];
        // } else {
        //     $utolsoOldal = $osszesOldal;
        //     $utolsoOldalOffset = ($utolsoOldal - 1) * $darab;
        //     $utolsoRows = DB::select(
        //         'SELECT * FROM osztalies
        //         LIMIT ? OFFSET ?', [$darab, $utolsoOldalOffset]
        //     );
        //     $data = [
        //         'message' => 'Hiba',
        //         'oldal' => "{$utolsoOldal}|{$osszesOldal}",
        //         'data' => $utolsoRows
        //     ];
        // }
    }
    public function queryOsztalyOldalSzam(int $darab)
    {


        $osszes = DB::select('SELECT COUNT(*) darab from osztalies');
        $osszes = $osszes[0]->darab;

        $oldalSzam = ceil($osszes / $darab);

        $data = [
            'message' => 'ok',
            'data' => [
                'oldalSzam' => $oldalSzam,
            ]
        ];


        return response()->json($data, options: JSON_UNESCAPED_UNICODE);
        // if (!($oldal > $osszesOldal || $oldal < 1)) {
        // } else {
        //     $utolsoOldal = $osszesOldal;
        //     $utolsoOldalOffset = ($utolsoOldal - 1) * $darab;
        //     $utolsoRows = DB::select(
        //         'SELECT * FROM osztalies
        //         LIMIT ? OFFSET ?', [$darab, $utolsoOldalOffset]
        //     );
        //     $data = [
        //         'message' => 'Hiba',
        //         'oldal' => "{$utolsoOldal}|{$osszesOldal}",
        //         'data' => $utolsoRows
        //     ];
        // }
    }
}

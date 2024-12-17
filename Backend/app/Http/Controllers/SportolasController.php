<?php

namespace App\Http\Controllers;

use App\Models\Sportolas;
use App\Http\Requests\StoreSportolasRequest;
use App\Http\Requests\UpdateSportolasRequest;
use Illuminate\Support\Facades\DB;

class SportolasController extends Controller
{
    public function index()
    {
        $rows = Sportolas::all();
        // $rows = Diak::orderBy('nev', 'asc')->get();
        return response()->json(['rows' => $rows], options: JSON_UNESCAPED_UNICODE);
    }

    public function store(StoreSportolasRequest $request)
    {

        $row = DB::table('sportolas')
            ->where('diakokId', $request['diakokId'])
            ->where('sportokId', $request['sportokId'])
            ->get();

        if ($row) {
            $data = [
                'message' => 'Append not redy, Duplicate problem',
                'diakokId' => $request['diakokId'],
                'sportokId' => $request['sportokId'],
            ];
            return response()->json($data, options: JSON_UNESCAPED_UNICODE);
        } else {
            # code...
            $row = Sportolas::create($request->all());
            return response()->json(['row' => $row], options: JSON_UNESCAPED_UNICODE);
        }
    }

    public function show(int $diakokId, int $sportokId)
    {
        // $row = Sportolas::find($id);
        $row = DB::table('sportolas')
            ->where('diakokId', $diakokId)
            ->where('sportokId', $sportokId)
            ->get();

        if ($row) {
            $data = ['row' => $row];
        } else {
            $data = [
                'message' => 'Not found',
                'diakokId' => $diakokId,
                'sportokId' => $sportokId,
            ];
        }
        return response()->json($data, options: JSON_UNESCAPED_UNICODE);
    }

    public function update(UpdateSportolasRequest $request,  int $diakokId, int $sportokId)
    {
        //Keresd meg az adott product-ot
        $row = DB::table('sportolas')
            ->where('diakokId', $diakokId)
            ->where('sportokId', $sportokId)
            ->get();

        if (count($row) > 0) {
            // $row->update($request->all());


            try {
                Sportolas::where('diakokId', $diakokId)
                    ->where('sportokId', $sportokId)
                    ->update([
                        'diakokId' => $request['diakokId'],
                        'sportokId' => $request['sportokId']
                    ]);
    
                $data = [
                    'diakokId' => $request['diakokId'],
                    'sportokId' => $request['sportokId']
                ];
                
            } catch (\Illuminate\Database\QueryException $e) {
                $data = [
                    'Error' => 'Duplicate key error',
                    'diakokId' => $request['diakokId'],
                    'sportokId' => $request['sportokId']
                ];
            }



        } else {
            $data = [
                'message' => 'Not found',
                'diakokId' => $diakokId,
                'sportokId' => $sportokId,
            ];
        }
        return response()->json($data, options: JSON_UNESCAPED_UNICODE);
    }

    public function destroy(int $diakokId, int $sportokId)
    {
        $row = DB::table('sportolas')
            ->where('diakokId', $diakokId)
            ->where('sportokId', $sportokId)
            ->get();


        if (count($row) > 0) {
            Sportolas::where('diakokId', $diakokId)
                ->where('sportokId', $sportokId)
                ->delete();

            $data = [
                'message' => 'Deleted successfully',
                'diakokId' => $diakokId,
                'sportokId' => $sportokId,
            ];
        } else {
            $data = [
                'message' => 'Not found',
                'diakokId' => $diakokId,
                'sportokId' => $sportokId,
            ];
        }
        return response()->json($data, options: JSON_UNESCAPED_UNICODE);
    }
}

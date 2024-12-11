<?php

namespace App\Http\Controllers;

use App\Models\Sportolas;
use App\Http\Requests\StoreSportolasRequest;
use App\Http\Requests\UpdateSportolasRequest;

class SportolasController extends Controller
{
    public function index()
    {
        $rows = Sportolas::all();
        return response()->json(['rows' => $rows], options: JSON_UNESCAPED_UNICODE);
    }

    public function store(StoreSportolasRequest $request)
    {
        $diakokId  = $request['diakokId'];
        $sportokId = $request['sportokId'];
        $row = Sportolas::where('diakokId', $diakokId)
            ->where('sportokId', $sportokId)
            ->get();

        if (count($row) != 0) {
            $data = [
                'message' => 'This record alredy exists',
                'diakokId' => $diakokId,
                'sportokId' => $sportokId,
            ];
        } else {
            $row = Sportolas::create($request->all());
            $data = $row;
        }
        return response()->json($data, options: JSON_UNESCAPED_UNICODE);
    }

    public function show(int $diakokId, int $sportokId)
    {
        $row = Sportolas::where('diakokId', $diakokId)
            ->where('sportokId', $sportokId)
            ->get();

        if (count($row) != 0) {
            $data = ['rows' => $row];
        } else {
            $data = [
                'message' => 'Not found',
                'diakokId' => $diakokId,
                'sportokId' => $sportokId,
            ];
        }

        return response()->json($data, options: JSON_UNESCAPED_UNICODE);
    }

    public function update(UpdateSportolasRequest $request, int $diakokId, int $sportokId)
    {

        $row = Sportolas::where('diakokId', $diakokId)
            ->where('sportokId', $sportokId)
            ->get();

        if (count($row) > 0) {

            try {
                //Udate megtörténik
                Sportolas::where('diakokId', $diakokId)
                    ->where('sportokId', $sportokId)
                    ->update(
                        [
                            'diakokId' => $request['diakokId'],
                            'sportokId' => $request['sportokId']
                        ]
                    );

                //visszakeressük        
                $row = Sportolas::where('diakokId', $request['diakokId'])
                    ->where('sportokId', operator: $request['sportokId'])
                    ->get();
                
                $data = [
                    'message' => 'Pach ok',
                    'row' => $row
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


        // $row = Sportolas::find($id);
        // if ($row) {
        //     $row->update($request->all());
        //     $data = [
        //         'row' => $row
        //     ];
        // } else {
        //     $data = [
        //         'message' => 'Not found',
        //         'id' => $id
        //     ];
        // }
        // return response()->json($data, options: JSON_UNESCAPED_UNICODE);
    }

    public function destroy(int $diakokId, int $sportokId)
    {
        $row = Sportolas::where('diakokId', $diakokId)
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

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
        return response()->json(['rows' => $rows], options:JSON_UNESCAPED_UNICODE);
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
            $data =$row;
        }
        return response()->json($data, options:JSON_UNESCAPED_UNICODE);

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
        
        return response()->json($data, options:JSON_UNESCAPED_UNICODE);

    }

    public function update(UpdateSportolasRequest $request, int $id)
    {
        $row = Sportolas::find($id);
        if ($row) {
            $row->update($request->all());
            $data = [
                'row' => $row
            ];
        } else {
            $data = [
                'message' => 'Not found',
                'id' => $id
            ];
        }
        return response()->json($data, options:JSON_UNESCAPED_UNICODE);
    }

    public function destroy(int $id)
    {
        $row = Sportolas::find($id);
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
        
        return response()->json($data, options:JSON_UNESCAPED_UNICODE);
    }

}

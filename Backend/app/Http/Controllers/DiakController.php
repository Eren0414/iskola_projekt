<?php

namespace App\Http\Controllers;

use App\Models\Diak;
use App\Http\Requests\StoreDiakRequest;
use App\Http\Requests\UpdateDiakRequest;

class DiakController extends Controller
{
    public function index()
    {
        $rows = Diak::all();
        return response()->json(['rows' => $rows], options:JSON_UNESCAPED_UNICODE);
    }

    public function store(StoreDiakRequest $request)
    {
        $rows = Diak::create(attributes: $request->all());
        return response()->json(['rows' => $rows], options:JSON_UNESCAPED_UNICODE);
    }

    public function show(int $id)
    {
        $rows = Diak::find($id);
        return response()->json(['rows' => $rows], options:JSON_UNESCAPED_UNICODE);
    }

    public function update(UpdateDiakRequest $request, int $id)
    {
        $row = Diak::find($id);
        if ($row) {

            try {
                $row->update($request->all());
                $data = [
                    'row' => $row
                ];
            } catch (\Illuminate\Database\QueryException $e) {
                $data = [
                    'message' => 'osztalyId incorrect',
                    'osztalyId' => $request['osztalyId']
                ];
            }

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
        
        return response()->json($data, options:JSON_UNESCAPED_UNICODE);
    }

}

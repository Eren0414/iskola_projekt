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
        // $rows = Diak::orderBy('nev', 'asc')->get();
        $data = [
            'message' => 'ok',
            'data' => $rows
        ];
        return response()->json($data, options: JSON_UNESCAPED_UNICODE);
    }

    public function store(StoreDiakRequest $request)
    {
        try {
            $row = Diak::create($request->all());
            $data = [
                'message' => 'ok',
                'data' => $row
            ];
        } catch (\Illuminate\Database\QueryException $e) {
            $data = [
                'message' => 'The post failed',
                'data' => $request->all()
            ];
        }

        return response()->json($data, options: JSON_UNESCAPED_UNICODE);
    }

    public function show(int $id)
    {
        $row = Diak::find($id);
        if ($row) {
            $data = [
                'message' => 'ok',
                'data' => $row
            ];
        } else {
            $data = [
                'message' => 'Not found',
                'data' => [
                    'id' => $id
                ]
            ];
        }
        return response()->json($data, options: JSON_UNESCAPED_UNICODE);
    }

    public function update(UpdateDiakRequest $request,  $id)
    {
        $row = Diak::find($id);
        if ($row) {

            try {
                $row->update($request->all());
                $data = [
                    'message' => 'ok',
                    'data' => $row
                ];
            } catch (\Illuminate\Database\QueryException $e) {
                $data = [
                    'message' => 'The patch failed',
                    'data' => $request->all()
                ];
            }

        } else {
            $data = [
                'message' => 'Not found',
                'data' => [
                    'id' => $id
                ]
            ];
        }
        return response()->json($data, options: JSON_UNESCAPED_UNICODE);
    }

    public function destroy(int $id)
    {
        $row = Diak::find($id);
        if ($row) {
            $row->delete();
            $data = [
                'message' => 'ok',
                'data' => [
                    'id' => $id
                ]
            ];
        } else {
            $data = [
                'message' => 'Not found',
                'data' => [
                    'id' => $id
                ]
            ];
        }
        return response()->json($data, options: JSON_UNESCAPED_UNICODE);
    }
}

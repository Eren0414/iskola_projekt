<?php

namespace App\Http\Controllers;

use App\Models\Osztaly;
use App\Http\Requests\StoreOsztalyRequest;
use App\Http\Requests\UpdateOsztalyRequest;

class OsztalyController extends Controller
{
    public function index()
    {
        $rows = Osztaly::all();
        $data = [
            'message' => 'ok',
            'data' => $rows
        ];

        return response()->json($data, options:JSON_UNESCAPED_UNICODE);
    }

    public function store(StoreOsztalyRequest $request)
    {
        $rows = Osztaly::create(attributes: $request->all());
        return response()->json(['rows' => $rows], options:JSON_UNESCAPED_UNICODE);
    }

    public function show(int $id)
    {
        $rows = Osztaly::find($id);
        return response()->json(['rows' => $rows], options:JSON_UNESCAPED_UNICODE);
    }

    public function update(UpdateOsztalyRequest $request, int $id)
    {
        $row = Osztaly::find($id);
        if ($row) {
            $row->update($request->all());
            $data = [
                'message' => 'ok',
                'row' => $row
            ];
        } else {
            $data = [
                'message' => 'Not found',
                'row' => [
                    'id' => $id
                ]
            ];
        }
        return response()->json($data, options:JSON_UNESCAPED_UNICODE);
    }

    public function destroy(int $id)
    {
        $row = Osztaly::find($id);
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

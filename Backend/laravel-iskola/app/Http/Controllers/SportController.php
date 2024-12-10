<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use App\Http\Requests\StoreSportRequest;
use App\Http\Requests\UpdateSportRequest;

class SportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rows = Sport::all();
        return response()->json(['rows' => $rows], options:JSON_UNESCAPED_UNICODE);
    }

    public function store(StoreSportRequest $request)
    {
        $rows = Sport::create(attributes: $request->all());
        return response()->json(['rows' => $rows], options:JSON_UNESCAPED_UNICODE);
    }

    public function show(int $id)
    {
        $rows = Sport::find($id);
        return response()->json(['rows' => $rows], options:JSON_UNESCAPED_UNICODE);
    }

    public function update(UpdateSportRequest $request, int $id)
    {
        $row = Sport::find($id);
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
        $row = Sport::find($id);
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

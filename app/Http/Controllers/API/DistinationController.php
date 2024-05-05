<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Distination;
use Illuminate\Support\Facades\Validator;

class DistinationController extends Controller
{
    public function index()
    {
        $distinations = Distination::all();
        return response()->json([
            'status' => 200,
            'distinations' => $distinations,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ville' => 'required|unique:distinations|string',
            'pays' => 'required|unique:distinations|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $distination = Distination::create($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Distination created successfully!',
            'Distination' => $distination,
        ], 200);
    }

    public function show($id)
    {
        $distination = Distination::find($id);

        if (!$distination) {
            return response()->json([
                'status' => 404,
                'message' => 'Distination not found!',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'distination' => $distination,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $distination = Distination::find($id);

        if (!$distination) {
            return response()->json([
                'status' => 404,
                'message' => 'Distination not found!',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'ville' => 'unique:distinations|string',
            'pays' => 'unique:distinations|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $distination->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'distination updated successfully!',
            'distination' => $distination,
        ], 200);
    }

    public function destroy($id)
    {
        $distination = Distination::find($id);

        if (!$distination) {
            return response()->json([
                'status' => 404,
                'message' => 'Distination not found!',
            ], 404);
        }

        $distination->delete();

        return response()->json([
            'status' => 200,
            'message' => 'distination deleted successfully!',
        ], 200);
    }
}



<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Compte;
use App\Models\Guide;
use Illuminate\Support\Facades\Validator;

class GuideController extends Controller
{
    public function index()
    {
        $guides = Guide::all();
        return response()->json([
            'status' => 200,
            'guides' => $guides,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cin' => 'required|unique:guides|string',
            'description' => 'required|string',
            'evaluation' => 'required|integer|max:5',
            'specialite' => 'required|string',
            'id_compte' => 'required|integer|exists:comptes,id_compte|unique:guides',            
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $guide = Guide::create($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'guide created successfully!',
            'guide' => $guide,
        ], 200);
    }

    public function show($id)
    {
        $guide = Guide::find($id);

        if (!$guide) {
            return response()->json([
                'status' => 404,
                'message' => 'Guide not found!',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'guide' => $guide,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $guide = Guide::find($id);

        if (!$guide) {
            return response()->json([
                'status' => 404,
                'message' => 'Guide not found!',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'cin' => 'unique:guides,cin,'.$id.'|string',
            'description' => 'string',
            'evaluation' => 'integer|max:5',
            'specialite' => 'string',
            'id_compte' => 'integer|exists:comptes,id_compte|unique:guides',
        ]);
       

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $guide->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Guide updated successfully!',
            'guide' => $guide,
        ], 200);
    }

    public function destroy($id)
    {
        $guide = Guide::find($id);

        if (!$guide) {
            return response()->json([
                'status' => 404,
                'message' => 'Guide not found!',
            ], 404);
        }

        $guide->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Guide deleted successfully!',
        ], 200);
    }
}

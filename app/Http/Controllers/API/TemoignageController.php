<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Utilisateur;
use App\Models\Temoignage;
use Illuminate\Support\Facades\Validator;

class TemoignageController extends Controller
{
    public function index()
    {
        $temoignages = Temoignage::all();
        return response()->json([
            'status' => 200,
            'temoignages' => $temoignages,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|string',
            'etoile' => 'required|integer',
            'id_utilisateur' => 'required|integer|exists:utilisateurs,id_utilisateur|unique:temoignages',
            
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $temoignage = Temoignage::create($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Temoignage created successfully!',
            'temoignage' => $temoignage,
        ], 200);
    }

    public function show($id)
    {
        $temoignage = Temoignage::find($id);

        if (!$temoignage) {
            return response()->json([
                'status' => 404,
                'message' => 'Temoignage not found!',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'temoignage' => $temoignage,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $temoignage = Temoignage::find($id);

        if (!$temoignage) {
            return response()->json([
                'status' => 404,
                'message' => 'Temoignage not found!',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'description' => 'string',
            'etoile' => 'integer',
            'id_utilisateur' => 'integer|exists:temoignages,id_temoignage|unique:utilisateurs',
        ]);
       

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $temoignage->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Temoignage updated successfully!',
            'temoignage' => $temoignage,
        ], 200);
    }

    public function destroy($id)
    {
        $temoignage = Temoignage::find($id);

        if (!$temoignage) {
            return response()->json([
                'status' => 404,
                'message' => 'Temoignage not found!',
            ], 404);
        }

        $temoignage->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Temoignage deleted successfully!',
        ], 200);
    }
}

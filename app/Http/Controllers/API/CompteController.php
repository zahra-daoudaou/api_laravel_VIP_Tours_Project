<?php

namespace App\Http\Controllers\API;

use App\Models\Compte;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompteController extends Controller
{
    public function index()
    {
        $comptes = Compte::all();
        return response()->json([
            'status' => 200,
            'comptes' => $comptes,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|unique:comptes|string',
            'motpass' => 'required|string',
            'type_Compte' => 'required|string',
            'nom' => 'required|string',
            'email' => 'required|string',
            'num_tel' => 'required|string',
            'photo' => 'required|string',
            'ville' => 'required|string',
            'pays' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $compte = Compte::create($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Compte created successfully!',
            'compte' => $compte,
        ], 200);
    }

    public function show($id)
    {
        $compte = Compte::find($id);

        if (!$compte) {
            return response()->json([
                'status' => 404,
                'message' => 'Compte not found!',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'compte' => $compte,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $compte = Compte::find($id);

        if (!$compte) {
            return response()->json([
                'status' => 404,
                'message' => 'Compte not found!',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'login' => 'unique:comptes,login,' . $id . '|string',
            'motpass' => 'string',
            'type_Compte' => 'string',
            'nom' => 'string',
            'email' => 'string',
            'num_tel' => 'string',
            'photo' => 'string',
            'ville' => 'string',
            'pays' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $compte->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Compte updated successfully!',
            'compte' => $compte,
        ], 200);
    }

    public function destroy($id)
    {
        $compte = Compte::find($id);

        if (!$compte) {
            return response()->json([
                'status' => 404,
                'message' => 'Compte not found!',
            ], 404);
        }

        $compte->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Compte deleted successfully!',
        ], 200);
    }
}

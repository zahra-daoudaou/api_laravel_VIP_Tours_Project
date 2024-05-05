<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Compte;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Validator;

class UtilisateurController extends Controller
{
    public function index()
    {
        $utilisateurs = Utilisateur::all();
        return response()->json([
            'status' => 200,
            'Utilisateurs' => $utilisateurs,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cin' => 'required|unique:utilisateurs|string',
            'address' => 'required|string',
            'id_compte' => 'required|integer|exists:comptes,id_compte|unique:utilisateurs',
            ]);

        /*
        'cin' => 'required|string|max:20|unique:utilisateurs,cin,NULL,id,id_compte,'.$request->input('id_compte'),
        'address' => 'required|string'.$request->input('id_compte'),
        'id_compte' => 'required|exists:comptes,id_compte|unique:utilisateurs,id_compte,NULL,id,cin,'.$request->input('id_compte'), 
        */

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $utilisateur = Utilisateur::create($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Utilisateur created successfully!',
            'Utilisateur' => $utilisateur,
        ], 200);
    }

    public function show($id)
    {
        $utilisateur = Utilisateur::find($id);

        if (!$utilisateur) {
            return response()->json([
                'status' => 404,
                'message' => 'Utilisateur not found!',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'Utilisateur' => $utilisateur,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $utilisateur = Utilisateur::find($id);

        if (!$utilisateur) {
            return response()->json([
                'status' => 404,
                'message' => 'Utilisateur not found!',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'cin' => 'unique:utilisateurs,cin,'.$id.'|string',
            'address' => 'string',
            'id_compte' => 'integer|exists:comptes,id_compte|unique:utilisateurs',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $utilisateur->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Utilisateur updated successfully!',
            'Utilisateur' => $utilisateur,
        ], 200);
    }

    public function destroy($id)
    {
        $utilisateur = Utilisateur::find($id);

        if (!$utilisateur) {
            return response()->json([
                'status' => 404,
                'message' => 'Utilisateur not found!',
            ], 404);
        }

        $utilisateur->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Utilisateur deleted successfully!',
        ], 200);
    }
}

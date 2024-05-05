<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Commentaire;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Validator;

class CommentaireController extends Controller
{
    public function index()
    {
        $commentaires = Commentaire::all();
        return response()->json([
            'status' => 200,
            'Commentaires' => $commentaires,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contenue' => 'required|string',
            'etat' => 'required|string',
            'id_utilisateur' => 'required|integer|exists:utilisateurs,id_utilisateur|unique:commentaires',
            'id_blog' => 'required|integer|exists:blogs,id_blog|unique:commentaires',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $commentaire = Commentaire::create($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'commentaire created successfully!',
            'commentaire' => $commentaire,
        ], 200);
    }

    public function show($id)
    {
        $commentaire = Commentaire::find($id);

        if (!$commentaire) {
            return response()->json([
                'status' => 404,
                'message' => 'commentaire not found!',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'commentaire' => $commentaire,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $commentaire = Commentaire::find($id);

        if (!$commentaire) {
            return response()->json([
                'status' => 404,
                'message' => 'commentaire not found!',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'contenue' => 'string',
            'etat' => 'string',
            'id_utilisateur' => 'integer|exists:commentaires,id_commentaire|unique:utilisateurs',
            'id_blog' => 'integer|exists:commentaires,id_commentaire|unique:blogs',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $commentaire->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'commentaire updated successfully!',
            'commentaire' => $commentaire,
        ], 200);
    }

    public function destroy($id)
    {
        $commentaire = Commentaire::find($id);

        if (!$commentaire) {
            return response()->json([
                'status' => 404,
                'message' => 'commentaire not found!',
            ], 404);
        }

        $commentaire->delete();

        return response()->json([
            'status' => 200,
            'message' => 'commentaire deleted successfully!',
        ], 200);
    }
}


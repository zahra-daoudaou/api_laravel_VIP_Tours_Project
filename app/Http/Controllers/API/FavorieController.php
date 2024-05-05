<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorie;
use App\Models\Utilisateur;
use App\Models\Blog;
use Illuminate\Support\Facades\Validator;

class FavorieController extends Controller
{
    public function index()
    {
        $favories = Favorie::all();
        return response()->json([
            'status' => 200,
            'favories' => $favories,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_utilisateur' => 'required|integer|exists:utilisateurs,id_utilisateur|unique:favories',
            'id_blog' => 'required|integer|exists:blogs,id_blog|unique:favories',
            
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $favorie = Favorie::create($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'favorie created successfully!',
            'favorie' => $favorie,
        ], 200);
    }

    public function show($id)
    {
        $favorie = Favorie::find($id);

        if (!$favorie) {
            return response()->json([
                'status' => 404,
                'message' => 'favorie not found!',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'favorie' => $favorie,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $favorie = Favorie::find($id);

        if (!$favorie) {
            return response()->json([
                'status' => 404,
                'message' => 'favorie not found!',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'id_utilisateur' => 'integer|exists:favories,id_favorie|unique:utilisateurs',
            'id_blog' => 'integer|exists:favories,id_favorie|unique:blogs',
        ]);
       

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $favorie->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'favorie updated successfully!',
            'favorie' => $favorie,
        ], 200);
    }

    public function destroy($id)
    {
        $favorie = Favorie::find($id);

        if (!$favorie) {
            return response()->json([
                'status' => 404,
                'message' => 'favorie not found!',
            ], 404);
        }

        $favorie->delete();

        return response()->json([
            'status' => 200,
            'message' => 'favorie deleted successfully!',
        ], 200);
    }
}

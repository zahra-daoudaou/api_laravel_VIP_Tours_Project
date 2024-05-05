<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\Tour;
use Illuminate\Support\Facades\Validator;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = Photo::all();
        return response()->json([
            'status' => 200,
            'photos' => $photos,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'chemain_photo' => 'required|unique:photos|string',
            'titre' => 'required|string',
            'id_tour' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $photo = Photo::create($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Photo created successfully!',
            'Photo' => $photo,
        ], 200);
    }

    public function show($id)
    {
        $photo = Photo::find($id);

        if (!$photo) {
            return response()->json([
                'status' => 404,
                'message' => 'Photo not found!',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'photo' => $photo,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $photo = Photo::find($id);

        if (!$photo) {
            return response()->json([
                'status' => 404,
                'message' => 'Photo not found!',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'chemain_photo' => 'unique:photos|string',
            'titre' => 'string',
            'id_tour' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $photo->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'photo updated successfully!',
            'photo' => $photo,
        ], 200);
    }

    public function destroy($id)
    {
        $photo = Photo::find($id);

        if (!$photo) {
            return response()->json([
                'status' => 404,
                'message' => 'Photo not found!',
            ], 404);
        }

        $photo->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Photo deleted successfully!',
        ], 200);
    }
}


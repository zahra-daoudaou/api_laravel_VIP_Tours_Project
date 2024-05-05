<?php

namespace App\Http\Controllers\API;

use App\Models\Language;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LanguageController extends Controller
{
    public function index()
    {
        $languages = Language::all();
        return response()->json([
            'status' => 200,
            'languages' => $languages,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom_language' => 'required|unique:languages|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $language = Language::create($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Language created successfully!',
            'language' => $language,
        ], 200);
    }

    public function show($id)
    {
        $language = Language::find($id);

        if (!$language) {
            return response()->json([
                'status' => 404,
                'message' => 'Language not found!',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'language' => $language,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $language = Language::find($id);

        if (!$language) {
            return response()->json([
                'status' => 404,
                'message' => 'Language not found!',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nom_language' => 'required|unique:languages,nom_language|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $language->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Language updated successfully!',
            'language' => $language,
        ], 200);
    }

    public function destroy($id)
    {
        $language = Language::find($id);

        if (!$language) {
            return response()->json([
                'status' => 404,
                'message' => 'Language not found!',
            ], 404);
        }

        $language->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Language deleted successfully!',
        ], 200);
    }
}

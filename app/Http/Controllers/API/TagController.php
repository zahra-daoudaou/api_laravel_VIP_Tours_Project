<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return response()->json([
            'status' => 200,
            'tags' => $tags,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_tag' => 'required|unique:tags|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $tag = Tag::create($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'tag created successfully!',
            'tag' => $tag,
        ], 200);
    }

    public function show($id)
    {
        $tag = Tag::find($id);

        if (!$tag) {
            return response()->json([
                'status' => 404,
                'message' => 'tag not found!',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'tag' => $tag,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $tag = Tag::find($id);

        if (!$tag) {
            return response()->json([
                'status' => 404,
                'message' => 'tag not found!',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name_tag' => 'unique:tags|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $tag->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'tag updated successfully!',
            'tag' => $tag,
        ], 200);
    }

    public function destroy($id)
    {
        $tag = Tag::find($id);

        if (!$tag) {
            return response()->json([
                'status' => 404,
                'message' => 'tag not found!',
            ], 404);
        }

        $tag->delete();

        return response()->json([
            'status' => 200,
            'message' => 'tag deleted successfully!',
        ], 200);
    }
}

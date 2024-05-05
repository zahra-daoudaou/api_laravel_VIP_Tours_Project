<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Guide;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return response()->json([
            'status' => 200,
            'blogs' => $blogs,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titre' => 'required|unique:blogs|string',
            'contenue' => 'required|string',
            'ville' => 'required|string',
            'pays' => 'required|string',
            'id_guide' => 'required|integer|exists:guides,id_guide|unique:blogs',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $blog = Blog::create($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Blog created successfully!',
            'blog' => $blog,
        ], 200);
    }

    public function show($id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json([
                'status' => 404,
                'message' => 'Blog not found!',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'blog' => $blog,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json([
                'status' => 404,
                'message' => 'Blog not found!',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'titre' => 'unique:blogs|string',
            'contenue' => 'string',
            'ville' => 'string',
            'pays' => 'string',
            'id_guide' => 'integer|exists:blogs,id_blog|unique:guides',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $blog->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Blog updated successfully!',
            'blog' => $blog,
        ], 200);
    }

    public function destroy($id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json([
                'status' => 404,
                'message' => 'Blog not found!',
            ], 404);
        }

        $blog->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Blog deleted successfully!',
        ], 200);
    }
}


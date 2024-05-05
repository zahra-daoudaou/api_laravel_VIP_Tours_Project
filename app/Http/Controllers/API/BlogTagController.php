<?php

namespace App\Http\Controllers\API;


use App\Models\Blog;
use App\Models\Tag;
use App\Models\BlogTag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class BlogTagController extends Controller
{

    public function index($id_blog)
    {
        $blog = Blog::find($id_blog);
        if (!$blog) {
            return response()->json(['message' => "Blog with ID '{$id_blog}' not found"], 404);
        }
    
        $tags = $blog->tags()->pluck('name_tag');
    
        return response()->json([
            'status' => 200,
            'blog' => $blog,
            'tags' => $tags,
        ]);
    }
 

 ///////////////////////////////////////////////////////// 


    public function addDistination(Request $request, $id_blog, $id_tag)
    {
        $blog = Blog::find($id_blog);
        if (!$blog) {
            return response()->json(['message' => "Blog with ID '{$id_blog}' not found"], 404);
        }

        $tag = Tag::find($id_tag);
        if (!$tag) {
            return response()->json(['message' => "Tag with ID '{$id_tag}' not found"], 404);
        }

        $blog->tags()->attach($id_tag);

        return response()->json(['message' => "Tag '{$tag->name_tag}' added successfully"], 200);
    }


// ////////////////////////////////////


    public function removeDistination(Request $request, $id_blog, $id_tag)
    {
        $blog = Blog::find($id_blog);
        if (!$blog) {
            return response()->json(['message' => "Blog with ID '{$id_blog}' not found"], 404);
        }

        $tag = Tag::find($id_tag);
        if (!$tag) {
            return response()->json(['message' => "Tag with ID '{$id_tag}' not found"], 404);
        }

        $blog->tags()->detach($id_tag);

        return response()->json(['message' => "Tag '{$tag->name_tag}' removed successfully"], 200);
    }
}

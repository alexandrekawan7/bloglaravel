<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', ['posts' => $posts]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $post = new Post;

        $file_name = time() . '.' . request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $file_name);

        $post->title = $request->title;
        $post->description = $request->description;
        $post->image = $file_name;

        $post->save();
        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function edit(Request $request) {
        switch ($request->method()) {
            case 'PUT':
                goto PUT;
            default:
                goto GET;
        }

    GET:
        $post = Post::find($request->id);

        Log::getLogger()->info($post);

        return view('posts.edit', ['post'=> $post]);
    PUT:
        Log::getLogger()->info($request);

        $request->validate([
            'title' => 'nullable',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $post = Post::find($request->id);

        if (isset($request->title)) {
            $post->title = $request->title;
        }

        if (isset($request->description)) {
            $post->description = $request->description;
        }

        if ($request->hasFile('image')) {
            $file_name = time() . '.' . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images'), $file_name);

            $post->image = $file_name;
        }

        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post edited successfully.');
    }

    public function show(Request $request)
    {
        $post = Post::find($request->id);

        return view('posts.show', ['post' => $post]);
    }

    public function destroy(Request $request) {
        $post = Post::find($request->id);

        if (isset($request->id)) {
            $post->delete();
            return redirect()->route('posts.index')->with('success','Post deleted succefully');
        }

        return redirect()->route('posts.index')->with('success','');
    }
}
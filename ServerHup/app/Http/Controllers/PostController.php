<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Server;
use App\Models\Category;
use  App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function create(Server $server)
    {
        $categories = Category::all();
        return view('posts.create', compact('server', 'categories'));
    }

    public function store(Request $request, Server $server)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
        ]);


        $validated['user_id'] = Auth::id();
        $validated['server_id'] = $server->id;

        Post::create($validated);

        return redirect()->route('servers.show', $server->id)->with('success', 'Post created successfully!');
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $post->update($validated);

        return redirect()->route('servers.show', $post->server_id)->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        $server_id = $post->server_id;
        $post->delete();

        return redirect()->route('servers.show', $server_id)->with('success', 'Post deleted successfully!');
    }


    public function storeComment(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $post = Post::findOrFail($postId);
        $server = $post->server;

        Comment::create([
            'content' => $request->content,
            'user_id' => Auth::id(),
            'post_id' => $post->id,
            'server_id' => $server->id,
        ]);

        return redirect()->back()->with('success', 'Comment added successfully!');
    }


}

<?php

namespace App\Http\Controllers;

use App\Models\Server;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servers = Server::with('posts', 'owner')->latest()->cursorPaginate(3);
        $relatedServersUser = auth()->user()->servers()->pluck('servers.id')->toArray();
        return view("servers.index", compact('servers' , 'relatedServersUser'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('servers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('servers', 'public');
            $validated['image'] = '/storage/' . $imagePath;
        }

        $validated['created_by'] = Auth::id();
        $server = Server::create($validated);

        $server->users()->attach(Auth::id());

        return redirect()->route('servers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Server $server, Request $request)
    {

    $categories = Category::all();

    $query = $server->posts()->with(['user', 'comments.user', 'category'])->latest();
    if($request->category_id) {
        $query->where('category_id', $request->category_id);
    }

    $posts = $query->paginate(5);

    return view('servers.show', compact('server', 'posts', 'categories'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Server $server)
    {
        return view('servers.edit', compact('server'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Server $server)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('servers', 'public');
        $validated['image'] = '/storage/' . $imagePath;
    }

    $server->update($validated);

    return redirect()->route('servers.show', $server->id);
    }

    public function join(Server $server)
    {
        if ($server->users->contains(auth()->id())) {
            return redirect()->back()->with('message', 'You are already a member of this server.');
        }

        $server->users()->attach(auth()->id());

        return redirect()->back()->with('message', 'You have successfully joined the server.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Server $server)
    {
        $server->delete();
        return redirect()->route('servers.index');
    }
}

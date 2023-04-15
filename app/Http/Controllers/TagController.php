<?php
namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    // Display a listing of the tags
    public function index()
    {
        $tags = Tag::query()->orderByDesc('name')->paginate(10);
        return view('tags.index', compact('tags'));
    }

    // Show the form for creating a new tag
    public function create()
    {
        return view('tags.create');
    }

    // Store a newly created tag in the database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:tags|max:255',
        ]);

        Tag::query()->create($validatedData);

        session()->flash('success', 'Tag created successfully.');

        return redirect()->route('tags.index');
    }

    // Display the specified tag
    public function show(Tag $tag)
    {
        return abort(404);
    }

    // Show the form for editing the specified tag
    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }

    // Update the specified tag in the database
    public function update(Request $request, Tag $tag)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:tags,name,' . $tag->id . '|max:255',
        ]);
        $tag->update($validatedData);
        session()->flash('success', 'Tag updated successfully.');
        return redirect()->route('tags.index');
    }

    // Remove the specified tag from the database
    public function destroy(Tag $tag)
    {
        $tag->delete();
        session()->flash('success', 'Tag deleted successfully.');
        return redirect()->route('tags.index');
    }
}

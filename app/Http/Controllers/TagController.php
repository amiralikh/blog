<?php

namespace App\Http\Controllers;

use App\Repository\TagRepo;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $tagRepository;

    public function __construct(TagRepo $tagRepo)
    {
        $this->tagRepository = $tagRepo;
    }

    public function index()
    {
        $tags = $this->tagRepository->getAllTags();
        return view('tags.index', compact('tags'));
    }

    public function create()
    {
        return view('tags.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:tags|max:255',
        ]);

        $this->tagRepository->createTag($validatedData['name']);

        session()->flash('success', 'Tag created successfully.');

        return redirect()->route('tags.index');
    }

    public function show($id)
    {
        return abort(404);
    }

    public function edit($id)
    {
        $tag = $this->tagRepository->findTagById($id);
        return view('tags.edit', compact('tag'));
    }

    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:tags,name,' . $id . '|max:255',
        ]);

        $tag = $this->tagRepository->findTagById($id);
        $this->tagRepository->updateTag($tag, $validatedData['name']);

        session()->flash('success', 'Tag updated successfully.');

        return redirect()->route('tags.index');
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $tag = $this->tagRepository->findTagById($id);
        $this->tagRepository->deleteTag($tag);
        session()->flash('success', 'Tag deleted successfully.');
        return redirect()->route('tags.index');
    }
}

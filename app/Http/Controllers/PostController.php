<?php

namespace App\Http\Controllers;

use App\Http\Requests\Blog\Post\Store;
use App\Repository\PostRepo;
use App\Repository\TagRepo;
use Illuminate\Support\Facades\App;

class PostController extends Controller
{

    protected $repo;
    public function __construct(PostRepo $blogRepo)
    {
        $this->repo = $blogRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = $this->repo->paginatedPosts();
        return view('posts.list',compact('posts'));
    }

    public function userPosts()
    {
        $posts = $this->repo->getUserPosts();
        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = App::make(TagRepo::class)->getAllTags();
        return view('posts.create',compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request)
    {
        $this->repo->store($request);
        session()->flash('success', 'Your post submitted successfully');
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = $this->repo->getPost($id);
        return view('posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = $this->repo->getPost($id);
        $tags = App::make(TagRepo::class)->getAllTags();
        return view('posts.edit',compact('post','tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Store $request, string $id)
    {
        $this->repo->update($id,$request);
        session()->flash('success', 'Your post updated successfully');
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->repo->destroy($id);
        request()->session()->flash('success', 'Your post deleted successfully');
        return redirect()->route('posts.index');
    }
}

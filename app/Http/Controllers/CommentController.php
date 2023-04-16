<?php

// app/Http/Controllers/CommentController.php
namespace App\Http\Controllers;

use App\Http\Requests\Blog\Comment\Store;
use App\Models\Comment;
use App\Models\Post;
use App\Repositories\CommentRepository;
use App\Repository\CommentRepo;
use App\Repository\PostRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private $commentRepository;

    public function __construct(CommentRepo $commentRepo)
    {
        $this->commentRepository = $commentRepo;
    }

    public function store(Store $request): \Illuminate\Http\RedirectResponse
    {
        $post = App::make(PostRepo::class)->getPost($request->input('post_id'));

        $comment = $this->commentRepository->create($request);
        $post->comments()->save($comment);

        session()->flash('success', 'Comment submitted successfully and after approving you can see that.');
        return back();
    }

    public function approve($id): \Illuminate\Http\RedirectResponse
    {
        $comment = $this->commentRepository->findOrFail($id);
        $this->commentRepository->update($comment, ['is_approved' => true]);

        session()->flash('success', 'Comment approved successfully.');

        return back();
    }

    public function edit($id): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $comment = $this->commentRepository->findOrFail($id);
        return view('comments.show', compact('comment'));
    }

    public function update(Request $request, Comment $comment): \Illuminate\Http\RedirectResponse
    {
        $validatedData = $request->validate([
            'content' => 'required',
        ]);

        $this->commentRepository->update($comment, $validatedData);

        session()->flash('success', 'Comment updated successfully.');

        return redirect()->route('posts.show', $comment->post);
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $this->commentRepository->delete($id);
        session()->flash('success', 'Comment deleted successfully.');
        return back();
    }

    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $comments = $this->commentRepository->paginateWithPostAndUser(10);
        return view('comments.index', compact('comments'));
    }
}

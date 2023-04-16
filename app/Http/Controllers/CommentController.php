<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Store a newly created comment in the database
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validatedData = $request->validate([
            'content' => 'required',
            'post_id' => 'required|exists:posts,id'
        ]);
        $post = Post::query()->findOrFail($request->input('post_id'));
        $comment = new Comment($validatedData);
        $comment->user_id = Auth::id();
        $post->comments()->save($comment);

        session()->flash('success', 'Comment submitted successfully and after approving you can see that.');
        return back();
    }

    // Approve the specified comment
    public function approve($id): \Illuminate\Http\RedirectResponse
    {
        $comment = Comment::query()->findOrFail($id);
        $comment->update(['is_approved' => true]);

        session()->flash('success', 'Comment approved successfully.');

        return back();
    }

    // Show the form for editing the specified comment
    public function edit($id): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $comment = Comment::query()->findOrFail($id);
        return view('comments.show', compact('comment'));
    }

    // Update the specified comment in the database
    public function update(Request $request, Comment $comment): \Illuminate\Http\RedirectResponse
    {
        $validatedData = $request->validate([
            'content' => 'required',
        ]);

        $comment->update($validatedData);

        session()->flash('success', 'Comment updated successfully.');

        return redirect()->route('posts.show', $comment->post);
    }

    // Remove the specified comment from the database
    public function destroy(Comment $comment): \Illuminate\Http\RedirectResponse
    {
        $comment->delete();
        session()->flash('success', 'Comment deleted successfully.');
        return back();
    }

    public function index()
    {
        $comments = Comment::with('post','user')->orderByDesc('created_at')->paginate(10);
        return view('comments.index',compact('comments'));
    }
}

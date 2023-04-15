<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Store a newly created comment in the database
    public function store(Request $request, Post $post): \Illuminate\Http\RedirectResponse
    {
        $validatedData = $request->validate([
            'content' => 'required',
        ]);

        $comment = new Comment($validatedData);
        $comment->user_id = Auth::id();
        $post->comments()->save($comment);

        session()->flash('success', 'Comment submitted successfully.');
        return back();
    }

    // Approve the specified comment
    public function approve(Comment $comment): \Illuminate\Http\RedirectResponse
    {
        $comment->update(['is_approved' => true]);

        session()->flash('success', 'Comment approved successfully.');

        return back();
    }

    // Show the form for editing the specified comment
    public function edit(Comment $comment): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('comments.edit', compact('comment'));
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
}

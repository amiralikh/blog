<?php

namespace App\Repository;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostRepo
{
    public function paginatedPosts()
    {
        return Post::with('user')->orderByDesc('created_at')->paginate(10);
    }

    public function getUserPosts()
    {
        return Post::with('user')->where('user_id',Auth::id())->orderByDesc('created_at')->paginate(10);
    }

    public function store($request)
    {
        $post = Post::query()->create([
            'user_id' => Auth::id(),
            'title' => $request->input('title'),
            'content' => $request->input('content')
        ]);
        self::syncTags($post,$request->input('tags'));

    }

    public function getPost($id)
    {
        return Post::with('user','comments','tags')->findOrFail($id);

    }


    public function getOwnUserPost($id)
    {
        return Post::query()->where(['user_id'=>Auth::id(),'id'=>$id])
            ->firstOrFail();
    }

    public function update($id,$request)
    {
       $post = self::getOwnUserPost($id);
       $post->update([
           'title' => $request->input('title'),
           'content' => $request->input('content')
       ]);
       self::syncTags($post,$request->input('tags'));
    }

    public function destroy($id)
    {
        self::getOwnUserPost($id)->delete();
    }

    public function syncTags($post, array $tagIds)
    {
        $post->tags()->sync($tagIds);
    }
}

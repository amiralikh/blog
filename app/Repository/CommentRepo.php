<?php

namespace App\Repository;

use App\Models\Comment;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class CommentRepo
{
    public function create($request): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
    {

        return Comment::query()->create([
            'content' => $request->input('content'),
            'post_id' => $request->input('post_id'),
            'user_id' => Auth::id(),
        ]);
    }

    public function findOrFail(int $id): Comment
    {
        return Comment::findOrFail($id);
    }

    public function update(Comment $comment, array $data): bool
    {
        return $comment->update($data);
    }

    public function delete($id): void
    {
        self::findOrFail($id)->delete();
    }

    public function paginateWithPostAndUser(int $perPage): LengthAwarePaginator
    {
        return Comment::with('post', 'user')->orderByDesc('created_at')->paginate($perPage);
    }
}

<?php

namespace App\Repository;

use App\Models\Comment;
use Illuminate\Pagination\LengthAwarePaginator;

class CommentRepo
{
    public function create(array $data): Comment
    {
        return Comment::create($data);
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

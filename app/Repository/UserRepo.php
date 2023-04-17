<?php

namespace App\Repository;

use App\Models\User;

class UserRepo
{
    public function getUsers(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return User::query()->withCount('posts','comments')->orderByDesc('name')->paginate(10);
    }

    public function activeUsers(): \Illuminate\Database\Eloquent\Collection|array
    {
        return User::query()->withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->limit(5)
            ->get();
    }


    // users who have no comments
    public function blindUsers()
    {
        return User::query()->doesntHave('comments')->paginate(10);
    }
}

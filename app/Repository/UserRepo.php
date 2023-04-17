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
    public function blindUsers(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return User::query()->doesntHave('comments')->paginate(10);
    }

    public function store($data): void
    {
        User::query()->create($data);
    }


    public function find(int $id): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Builder|array|null
    {
        return User::query()->findOrFail($id);
    }

    public function update($id,$data): void
    {
        $user = $this->find($id);
        $user->update($data);
    }


    public function delete(int $id): void
    {
        $user = $this->find($id);
        $user->delete();
    }


}

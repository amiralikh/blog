<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

    public function store($request): void
    {
        User::query()->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'is_admin' => (bool)$request->input('is_admin'),
        ]);
    }


    public function find(int $id): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Builder|array|null
    {
        return User::query()->findOrFail($id);
    }

    public function update($id,$request): void
    {
        $user = $this->find($id);
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'is_admin' => (bool)$request->input('is_admin'),
        ]);
        if ($request->input('password')){
            $user->update([
                'password' => Hash::make($request->input('password'))
            ]);
        }
    }


    public function destroy(int $id): void
    {
        $user = $this->find($id);
        $user->delete();
    }


}

<?php

namespace App\Repository;

use App\Models\Tag;

class TagRepo
{
    public function getAllTags($perPage = 10): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return Tag::query()->orderByDesc('name')->paginate($perPage);
    }

    public function createTag($name): Tag
    {
        $tag = new Tag();
        $tag->name = $name;
        $tag->save();
        return $tag;
    }

    public function updateTag(Tag $tag, $name): Tag
    {
        $tag->name = $name;
        $tag->save();
        return $tag;
    }

    public function deleteTag(Tag $tag): void
    {
        $tag->delete();
    }

    public function findTagById($id)
    {
        return Tag::query()->findOrFail($id);
    }
}

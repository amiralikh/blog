<?php

namespace App\Repository;

use App\Models\Tag;
use Illuminate\Support\Facades\DB;

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

    public function commonTags()
    {
        return Tag::select('tags.*', DB::raw('count(post_tags.tag_id) as tag_count'))
            ->join('post_tags', 'post_tags.tag_id', '=', 'tags.id')
            ->groupBy('post_tags.tag_id', 'tags.id', 'tags.name', 'tags.created_at', 'tags.updated_at')
            ->orderBy('tag_count', 'desc')
            ->limit(5)
            ->get();
    }
}

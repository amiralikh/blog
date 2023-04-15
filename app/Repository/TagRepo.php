<?php

namespace App\Repository;

use App\Models\Tag;

class TagRepo
{
    public function getAllTags()
    {
        return Tag::query()->orderByDesc('name')->get();
    }
}

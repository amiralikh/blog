<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Repository\PostRepo;
use App\Repository\TagRepo;
use App\Repository\UserRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    public function index()
    {
        $data['comments_posts']= App::make(PostRepo::class)->top5Post();
        $data['tags_posts'] = App::make(PostRepo::class)->topTagsPost();
        $data['active_users'] = App::make(UserRepo::class)->activeUsers();
        $data['common_tags'] = App::make(TagRepo::class)->commonTags();
        return view('home.index',compact('data'));
    }
}

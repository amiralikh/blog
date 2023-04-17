<?php

namespace App\Http\Controllers;

use App\Repository\UserRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class UserController extends Controller
{

    protected $repo;
    public function __construct(UserRepo $userRepo)
    {
        $this->repo = $userRepo;
    }


    public function index()
    {
        $users = $this->repo->getUsers();
        $title = 'Users List';
        return view('users.index',compact('users','title'));
    }

    // users with no comments
    public function blindUsers()
    {
        $users = $this->repo->blindUsers();
        $title = 'Inactive Users';
        return view('users.index',compact('users','title'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\Store;
use App\Repository\UserRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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


    public function destroy($id)
    {
        if (auth()->id() != $id){
            $this->repo->destroy($id);
            session()->flash('success', 'User deleted successfully.');
            return redirect()->route('users.index');
        } else {
            session()->flash('warning', 'You can not delete your self');
            return redirect()->route('users.index');
        }

    }

    public function store(Store $request)
    {
        $data['password'] = bcrypt($request['password']);
        $this->repo->store($data);
    }

    public function edit($id)
    {

    }

    public function update($id,Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required|string|email|max:255,unique,users,email,'.$id],
            'password' => 'nullable|string|min:8|confirmed',
            'is_admin' => 'sometimes|boolean',
        ]);

        if ($validatedData['password']) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $this->repo->update($id,$validatedData);
        session()->flash('success', 'User updated successfully.');
        return redirect()->route('users.index');
    }


}

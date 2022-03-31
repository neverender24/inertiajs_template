<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function index(Request $request) {

        return inertia('Users/Index', [
            //returns an array of users with name field only
            "users" => User::
                when($request->search, function ($query, $searchItem) {
                    $query->where('name', 'like', '%' . $searchItem . '%');
                })
                ->orderBy('created_at', 'desc')    
                ->paginate(10)
                ->withQueryString()
                ->through(fn($user) => [
                    'id' => $user->id,
                    'name' => $user->name,
                    "can" => [
                        'edit' => auth()->user()->can('edit', $user)
                    ]
                ]),
            "filters" => $request->only(['search']),
            "can" => [
                'createUser' => auth()->user()->can('create', User::class)
            ]
        ]);
    }

    public function create() {
        return inertia('Users/Create');
    }

    public function store(Request $request) {
        $attributes = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        User::create($attributes);

        return redirect('/users')->with('message', 'User created');
    }

    public function edit(Request $request, $id) {

        $data = User::where('id', $id)->first([
            'name', 'id', 'email'
        ]);

        return inertia('Users/Create',[
            "editData" => $data
        ]);
    }

    public function update(Request $request) {
        $data = User::findOrFail($request->id);
        $data->update([
            'name' => $request->name
        ]);

        return redirect('/users')->with('message', 'User updated');
    }

    public function destroy(Request $request) {
        $data = User::findOrFail($request->id);
        $data->delete();

        return redirect('/users')->with('message', 'User deleted');;
    }
}

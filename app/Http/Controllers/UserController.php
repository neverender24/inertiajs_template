<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }
    
    public function index(Request $request)
    {

        return inertia('Users/Index', [
            //returns an array of users with name field only
            "users" => $this->model->
                when($request->search, function ($query, $searchItem) {
                $query->where('name', 'like', '%' . $searchItem . '%');
            })
                ->orderBy('created_at', 'desc')
                ->simplePaginate(10)
                ->withQueryString()
                ->through(fn($user) => [
                    'id' => $user->id,
                    'name' => $user->name,
                    "can" => [
                        'edit' => auth()->user()->can('edit', $user),
                    ],
                ]),
            "filters" => $request->only(['search']),
            "can" => [
                'createUser' => auth()->user()->can('create', $this->model->class),
            ],
        ]);
    }

    public function create()
    {
        return inertia('Users/Create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        $this->model->create($attributes);

        return redirect('/users')->with('message', 'User created');
    }

    public function edit(Request $request, $id)
    {

        $data = $this->model->where('id', $id)->first([
            'name', 'id', 'email',
        ]);

        return inertia('Users/Create', [
            "editData" => $data,
        ]);
    }

    public function update(Request $request)
    {
        $data = $this->model->findOrFail($request->id);
        $data->update([
            'name' => $request->name,
        ]);

        return redirect('/users')->with('message', 'User updated');
    }

    public function destroy(Request $request)
    {
        $data = $this->model->findOrFail($request->id);
        $data->delete();

        return redirect('/users')->with('message', 'User deleted');
    }

    public function changePassword()
    {
        return inertia("Users/ChangePassword");
    }

    public function updatePassword(Request $request)
    {
        $old = $request->old;
        $new = $request->new;
        $confirm = $request->confirm;

        if (!Hash::check($old, auth()->user()->password)) {
            return back()->with('error', 'Wrong Credentials');
        }

        if ($new !== $confirm) {
            return back()->with('error', 'Not the same');
        }

        $user = $this->model->findOrFail(auth()->user()->id);
        $user->password = bcrypt($new);
        $user->save();

        return back()->with('message', 'Password Updated');
    }

    public function settings()
    {
        return inertia('Users/Settings');
    }

    public function changeName(Request $request) {
        $data = $this->model->findOrFail(auth()->user()->id);
        $data->update([
            'name' => $request->name,
        ]);

        return redirect('/users/settings')->with('message', 'User updated');
    }

    public function changePhoto(Request $request) {
        $data = $this->model->findOrFail(auth()->user()->id);

        $temporaryFile = TemporaryFile::where('folder', $request->folder)->first();

        if ($temporaryFile) {
            $data->addMedia(storage_path('app/avatars/tmp/' . $request->folder . '/' . $temporaryFile->filename))
                 ->toMediaCollection('avatars');

            rmdir(storage_path('app/avatars/tmp/' . $request->folder));
            $temporaryFile->delete();
        }

        return redirect('/users/settings')->with('message', 'User updated');
    }
}

<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminUsersController extends Controller
{
    private $rules = [
        'name' => 'required',
        'email' => 'required|unique:users,email',
        'password' => 'required|min:8,max:20',
        'image' => 'required|file|mimes:jpg,png,svg,webp,jpeg',
        'role_id' => 'required|numeric',
    ];

    public function index()
    {
        return view('admin_dashboard.users.index', [
            'users' => User::with(['role', 'image'])->paginate(50),
        ]);
    }

    public function create()
    {
        return view('admin_dashboard.users.create', [
            'roles' => Role::pluck('name', 'id'),
        ]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate($this->rules);
        $validated['password'] = Hash::make($request->input('password'));
        $user = User::create($validated);

        if (request()->has('image')) {
            $thumbnail = request()->file('image');
            $filename = $thumbnail->getClientOriginalName();
            $file_extension = $thumbnail->getClientOriginalExtension();
            $path = $thumbnail->store('images', 'public');

            $user->image()->create([
                'name' => $filename,
                'extension' => $file_extension,
                'path' => $path,
            ]);
        }

        return redirect()->route('admin.users.create')->with('success', 'User has been created');
    }

    public function show(User $user)
    {
        return view('admin_dashboard.users.show', [
            'user' => $user,
        ]);
    }
    public function edit(User $user)
    {
        return view('admin_dashboard.users.edit', [
            'user' => $user,
            'roles' => Role::pluck('name', 'id'), 
        ]);
    }

    public function update(Request $request, User $user)
    {
        $this->rules['password'] = 'nullable|min:8|max:20';
        $this->rules['email'] = ['required', 'email', Rule::unique('users')->ignore($user)];

        $validated = $request->validate($this->rules);
        
        if($validated['password'] === null){
            unset($validated['password']);
        }else{
          $validated['password'] = Hash::make($request->input('password'));  
        }
        
        $user->update($validated);

        if (request()->has('image')) {
            $thumbnail = request()->file('image');
            $filename = $thumbnail->getClientOriginalName();
            $file_extension = $thumbnail->getClientOriginalExtension();
            $path = $thumbnail->store('images', 'public');

            $user->image()->update([
                'name' => $filename,
                'extension' => $file_extension,
                'path' => $path,
            ]);
        }

        return redirect()->route('admin.users.edit', $user)->with('success', 'User has been edited');
    }

    function destroy(User $user)
    {
        if($user->id === auth()->id()){
            return redirect()->back()->with('error', 'You cannot delete your self');
        }

        User::whereHas('role', function($query){
            $query->where('name', 'admin');
        })->first()->posts()->saveMany($user->posts);

        $user->delete();
        return redirect()->route('admin.users.index', $user)->with('success', 'User has been deleted');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Plantel;
use Illuminate\Http\Request;
use App\Models\EducationLevel;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest('id')->paginate(10); // Retrieve all users from the database
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        $plantels = Plantel::all();
        $educationLevels = EducationLevel::all();
        return view('admin.users.create', compact('roles', 'plantels', 'educationLevels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $user)
    {    
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'image' => 'nullable|image',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id',
            'plantel_id' => 'nullable|exists:plantels,id',
            'education_level_id' => 'nullable|exists:education_levels,id',
        ]);

        $data = $request->only('name', 'email', 'phone', 'plantel_id', 'education_level_id');
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profile-photos', 'public');
            $data['profile_photo_path'] = $imagePath;
        }

        $user = User::create($data);

        if ($request->filled('roles')) {
            $user->roles()->sync($request->roles);
        }

        Session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Usuario Creado!',
            'text' => 'Se ha creado el usuario con éxito.',
        ]);

        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {

        $roles = Role::all();
        $plantels = Plantel::all();
        $educationLevels = EducationLevel::all();
        return view('admin.users.edit', compact('user', 'roles', 'plantels', 'educationLevels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|string|email|max:255|unique:users,email,{$user->id}",
            'phone' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'image' => 'nullable|image',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id',
            'plantel_id' => 'nullable|exists:plantels,id',
            'education_level_id' => 'nullable|exists:education_levels,id',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->plantel_id = $request->plantel_id;
        $user->education_level_id = $request->education_level_id;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('image')) {
            if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }
            $imagePath = $request->file('image')->store('profile-photos', 'public');
            $user->profile_photo_path = $imagePath;
        }

        $user->save();

        if ($request->filled('roles')) {
            $user->roles()->sync($request->roles);
        }

        Session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Usuario Creado!',
            'text' => 'Se ha creado el usuario con éxito.',
        ]);

        //Retornar
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        $user->delete();

        Session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Usuario Eliminado!',
            'text' => 'Se ha eliminado el usuario con éxito.',
        ]);

        return redirect()->route('admin.users.index');
    }
}

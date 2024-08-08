<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => ['required', 'unique:roles,name'],
            'permissions' => 'nullable|array',
        ]);

        $role = Role::create($request->all());
        $role->permissions()->sync($request->permissions);

        Session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Rol Creado!',
            'text' => 'El rol se creo con éxito.',
        ]);
        return redirect()->route('admin.roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('admin.roles.show', compact('role')); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        // $permissions = $role->permissions->pluck('id')->toArray();        

        $permissions = Permission::all();
        return view('admin.roles.edit' , compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        // dd($request->all());
        $request->validate([
            'name' => ['required', 'unique:roles,name,' . $role->id]
        ]);

        $role->update($request->all());
        $role->permissions()->sync($request->permissions);

        Session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Rol Actualizado!',
            'text' => 'El rol se actualizo con éxito.',
        ]);
        return redirect()->route('admin.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        Session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Rol Eliminado!',
            'text' => 'El rol se eliminó con éxito.',
        ]);
        return redirect()->route('admin.roles.index');

    }
}

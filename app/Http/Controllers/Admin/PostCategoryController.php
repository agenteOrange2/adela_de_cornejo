<?php

namespace App\Http\Controllers\Admin;

use App\Models\PostCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = PostCategory::all();
        return view('admin.postcategories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.postcategories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        PostCategory::create($request->all());

        Session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Categoría Creada!',
            'text' => 'Se ha creado la categoría con éxito.',
        ]);       

        //Retornar
        return redirect()->route('admin.categories-avisos.index');    
    }

    public function show(PostCategory $categories_avisos)
    {
        return view('admin.postcategories.show');
    }

    public function edit(PostCategory $categories_aviso)
    {
        return view('admin.postcategories.edit', compact('categories_aviso'));
    }

    public function update(Request $request, PostCategory $categories_aviso)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $categories_aviso->update($request->all());

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Categoría Actualizada!',
            'text' => 'Se actualizó la categoría con éxito.',
        ]);

        return redirect()->route('admin.categories-avisos.index');
    }

    public function destroy(PostCategory $categories_aviso)    
    {
        // Verifica si hay eventos asociados en la tabla pivot
        if ($categories_aviso->posts()->exists()) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Error!',
                'text' => 'La categoría no se puede eliminar porque tiene eventos asociados.',
            ]);
    
            return redirect()->route('admin.categories-avisos.index');
        }
    
        // Elimina la categoría si no hay eventos asociados
        $categories_aviso->delete();
    
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Categoría Eliminada!',
            'text' => 'Se eliminó la categoría con éxito.',
        ]);
    
        return redirect()->route('admin.categories-avisos.index');
    }
}

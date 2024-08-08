<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\EventCategory;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class EventCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = QueryBuilder::for(EventCategory::class)
        ->allowedFilters([
            AllowedFilter::partial('name'),
        ])
        ->paginate(5);
        return view('admin.eventcategories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.eventcategories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        //Almacenar
        EventCategory::create($request->all());

        Session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Categoría Creada!',
            'text' => 'Se ha creado la categoría con éxito.',
        ]);       

        //Retornar
        return redirect()->route('admin.categories-eventos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(EventCategory $eventCategory)
    {
        return view('admin.eventcategories.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EventCategory $categories_evento)
    {
        return view('admin.eventcategories.edit', compact('categories_evento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EventCategory $categories_evento)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        $categories_evento->update($request->all());
    
        Session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Categoría Actualizada!',
            'text' => 'Se actualizó la categoría con éxito.',
        ]);  
    
        return redirect()->route('admin.categories-eventos.index', $categories_evento);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventCategory $categories_evento)
    {
        // Verifica si hay eventos asociados en la tabla pivot
        if ($categories_evento->events()->exists()) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Error!',
                'text' => 'La categoría no se puede eliminar porque tiene eventos asociados.',
            ]);
    
            return redirect()->route('admin.categories-eventos.index');
        }
    
        // Elimina la categoría si no hay eventos asociados
        $categories_evento->delete();
    
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Categoría Eliminada!',
            'text' => 'Se eliminó la categoría con éxito.',
        ]);
    
        return redirect()->route('admin.categories-eventos.index');
    }
    
    
}

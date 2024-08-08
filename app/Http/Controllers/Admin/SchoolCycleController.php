<?php

namespace App\Http\Controllers\Admin;

use App\Models\SchoolCycle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SchoolCycleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $ciclos = SchoolCycle::latest('id')->paginate();
        return view('admin.calendarios.cicloescolar.index', compact('ciclos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.calendarios.cicloescolar.create');
    }


    public function show(SchoolCycle $ciclo_escolar)
    {
        return view('admin.ciclo-escolar.show', compact('ciclo_escolar'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $cycle = new SchoolCycle;
        $cycle->name = $request->input('name');
        $cycle->start_date = $request->input('start_date');
        $cycle->end_date = $request->input('end_date');
        $cycle->save();


        Session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Creado con éxito!',
            'text' => 'El ciclo escolar ha sido creado correctamente.',
        ]);

        return redirect()->route('admin.ciclo-escolar.index');
    }

    public function edit(SchoolCycle $ciclo_escolar)
    {
        return view('admin.calendarios.cicloescolar.edit', compact('ciclo_escolar'));
    }

    public function update(Request $request, SchoolCycle $ciclo_escolar)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $ciclo_escolar->update($request->all());

        Session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Actualizado con éxito!',
            'text' => 'El ciclo escolar se ha actualizado correctamente.',
        ]);
        return redirect()->route('admin.ciclo-escolar.index')->with('success', 'Ciclo escolar actualizado con éxito.');
    }


    public function destroy(SchoolCycle $ciclo_escolar)
    {
        $ciclo_escolar->delete();

        Session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Ciclo Borrado!',
            'text' => 'Se elimino el ciclo escolar con éxito.',
        ]);
        return redirect()->route('admin.ciclo-escolar.index', $ciclo_escolar);
    }
}

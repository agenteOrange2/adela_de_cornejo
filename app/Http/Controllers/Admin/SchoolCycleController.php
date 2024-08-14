<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plantel;
use App\Models\SchoolCycle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SchoolCycleController extends Controller
{
    public function index(Request $request)
    {
        $schoolCycles = SchoolCycle::all();
        $planteles = Plantel::all();
        $months = [
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre'
        ];
    
        // Obtener el plantel_id desde la solicitud, o usar un valor por defecto (por ejemplo, null)
        $plantelId = $request->input('plantel', null);
    
        return view('admin.cicloescolar.index', compact('schoolCycles', 'planteles', 'months'));
    }
    

    public function create()
    {
        return view('admin.cicloescolar.create');
    }

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

        return redirect()->route('admin.calendarios.cicloescolar.index');
    }

    public function edit(SchoolCycle $ciclo_escolar)
    {
        return view('admin.cicloescolar.edit', compact('ciclo_escolar'));
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
        return redirect()->route('admin.cicloescolar.index')->with('success', 'Ciclo escolar actualizado con éxito.');
    }

    public function destroy(SchoolCycle $ciclo_escolar)
    {
        $ciclo_escolar->delete();

        Session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Ciclo Borrado!',
            'text' => 'Se eliminó el ciclo escolar con éxito.',
        ]);
        return redirect()->route('admin.cicloescolar.index');
    }
}

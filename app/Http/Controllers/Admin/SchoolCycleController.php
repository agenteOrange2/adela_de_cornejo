<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plantel;
use App\Models\SchoolCycle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SchoolCycleController extends Controller
{
    public function index()
    {
        $schoolCycles = SchoolCycle::all()->map(function ($cycle) {
            $cycle->formatted_start_date = $cycle->start_date ? $cycle->start_date->format('d/m/Y') : null;
            $cycle->formatted_end_date = $cycle->end_date ? $cycle->end_date->format('d/m/Y') : null;
            return $cycle;
        });
        return view('admin.cicloescolar.index', compact('schoolCycles'));
    }

    public function store(Request $request)
    {
  //      dd($request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_current' => 'sometimes|boolean',
        ]);

        // Si el ciclo escolar actual se selecciona, asegúrate de desmarcar todos los demás
        if ($request->has('is_current') && $request->input('is_current') == 1) {
            SchoolCycle::where('is_current', 1)->update(['is_current' => 0]);
        }

        SchoolCycle::create([
            'name' => $request->input('name'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),            
            'is_current' => $request->input('is_current', 0),
        ]);
        Session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Creado con éxito!',
            'text' => 'El ciclo escolar ha sido creado correctamente.',
        ]);

        return redirect()->route('admin.ciclo-escolar.index');
    }

    public function update(Request $request, SchoolCycle $ciclo_escolar)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_current' => 'sometimes|boolean', // Validación del checkbox
        ]);

        // Verificar si el ciclo escolar es el actual
        if ($request->input('is_current') == 1) {
            SchoolCycle::where('is_current', 1)->update(['is_current' => 0]);
        }
        $ciclo_escolar->update([
            'name' => $request->input('name'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'is_current' => $request->input('is_current', 0),
        ]);

        Session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Actualizado con éxito!',
            'text' => 'El ciclo escolar se ha actualizado correctamente.',
        ]);

        return redirect()->route('admin.ciclo-escolar.index');
    }

    public function destroy(SchoolCycle $ciclo_escolar)
    {
        $ciclo_escolar->delete();

        return redirect()->route('admin.ciclo-escolar.index');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pdf;
use App\Models\Plantel;
use App\Models\SchoolCycle;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\EducationLevel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private function getMonths()
    {
        return [
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
    }

    public function index(Request $request)
    {
        $plantelId = $request->query('plantel_id', null);
        $levelId = $request->query('education_level_id', null);

        // No necesitamos $month, ya que usamos $start_month y $end_month
        $pdfs = Pdf::whereHas('educationLevels', function ($query) use ($levelId, $plantelId) {
            if ($levelId) {
                $query->where('education_level_id', $levelId);
            }
            if ($plantelId) {
                $query->where('plantel_id', $plantelId);
            }
        })->get();

        $schoolCycle = SchoolCycle::where('is_current', 1)->first();
        $planteles = Plantel::all();
        $educationLevels = EducationLevel::all();
        $months = $this->getMonths();

        // Ya no pasamos 'month', pero sí pasamos 'start_month' y 'end_month' si los necesitas en la vista.
        return view('admin.calendarios.index', compact('pdfs', 'planteles', 'educationLevels', 'schoolCycle', 'months', 'plantelId', 'levelId'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pdf' => 'required|file|mimes:pdf|max:10000',
            'education_level_id' => 'required|exists:education_levels,id',
            'plantel_ids' => 'required|array',
            'plantel_ids.*' => 'exists:plantels,id',
            'start_month' => 'required|integer|min:1|max:12',
            'end_month' => 'required|integer|min:1|max:12|gte:start_month',
            'school_cycle_id' => 'required|exists:school_cycles,id',
        ]);

        // Guardar el archivo PDF
        $file = $request->file('pdf');
        $filename = $file->getClientOriginalName();
        $folderName = 'calendarios/' . Str::slug($request->input('school_cycle_id'));
        $path = $file->storeAs($folderName, $filename, 'public');

        // Crear el registro del PDF en la base de datos
        $pdf = Pdf::create([
            'name' => $filename,
            'file_path' => $path,
            'pdfable_id' => $request->input('education_level_id'),
            'pdfable_type' => EducationLevel::class,
        ]);

        // Asociar el PDF con los planteles, ciclo escolar, y meses
        foreach ($request->input('plantel_ids') as $plantelId) {
            $pdf->educationLevels()->attach($request->input('education_level_id'), [
                'plantel_id' => $plantelId,
                'school_cycle_id' => $request->input('school_cycle_id'),
                'start_month' => $request->input('start_month'),
                'end_month' => $request->input('end_month'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        Session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Calendario!',
            'text' => 'El Calendario se creó con éxito.'
        ]);

        return redirect()->route('admin.calendarios.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $calendario)
    {
        //dd($request->all());

        $pdf = Pdf::findOrFail($calendario);
        $request->validate([
            'pdf' => 'nullable|file|mimes:pdf|max:10000',
            'education_level_id' => 'required|exists:education_levels,id',
            'plantel_ids' => 'required|array',
            'plantel_ids.*' => 'exists:plantels,id',
            'start_month' => 'required|integer|min:1|max:12',
            'end_month' => 'required|integer|min:1|max:12|gte:start_month',
            'school_cycle_id' => 'required|exists:school_cycles,id',
        ]);

        if ($request->hasFile('pdf')) {
            if ($pdf->file_path && Storage::disk('public')->exists($pdf->file_path)) {
                Storage::disk('public')->delete($pdf->file_path);
            }

            $file = $request->file('pdf');
            $filename = $file->getClientOriginalName();
            $folderName = 'calendarios/' . Str::slug(Plantel::find($request->input('plantel_ids')[0])->name);
            $path = $file->storeAs($folderName, $filename, 'public');
            $pdf->file_path = $path;
            $pdf->name = $filename;
        }

        $pdf->pdfable_id = $request->input('education_level_id');
        $pdf->pdfable_type = EducationLevel::class;
        $pdf->save();

        $syncData = [];
        foreach ($request->input('plantel_ids') as $plantelId) {
            $syncData[$plantelId] = [
                'school_cycle_id' => $request->input('school_cycle_id'),
                'start_month' => $request->input('start_month'),
                'end_month' => $request->input('end_month'),
            ];
        }
        dd($syncData);
        Log::info('syncData:', $syncData);
        $pdf->planteles()->sync($syncData);

        return redirect()->route('admin.calendarios.index')->with('success', 'PDF actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pdf = Pdf::findOrFail($id);

        if (Storage::disk('public')->exists($pdf->file_path)) {
            Storage::disk('public')->delete($pdf->file_path);
        }

        $pdf->educationLevels()->detach();
        $pdf->delete();

        return redirect()->route('admin.calendarios.index')->with('success', 'PDF eliminado correctamente.');
    }
}

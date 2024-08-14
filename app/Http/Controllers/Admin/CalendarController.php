<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pdf;
use App\Models\Plantel;
use App\Models\SchoolCycle;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\EducationLevel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $plantelId = $request->query('plantel_id', null);
        $month = $request->query('month', null);
        $levelId = $request->query('education_level_id', null); // Asegúrate de capturar este valor
    
        $pdfs = Pdf::whereHas('educationLevels', function ($query) use ($levelId, $plantelId, $month) {
            if ($levelId) {
                $query->where('education_level_id', $levelId);
            }
            if ($plantelId) {
                $query->where('plantel_id', $plantelId);
            }
            if ($month) {
                $query->where('month', $month);
            }
        })->get();
    
        $planteles = Plantel::all();
        $educationLevels = EducationLevel::all();
        $months = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
            5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
            9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];
    
        return view('admin.calendarios.index', compact('pdfs', 'planteles', 'educationLevels', 'months', 'plantelId', 'month', 'levelId'));
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //  dd($request->all());
        $request->validate([
            'pdf' => 'required|file|mimes:pdf|max:10000',
            'education_level_id' => 'required|exists:education_levels,id',
            'plantel_ids' => 'required|array',
            'plantel_ids.*' => 'exists:plantels,id',
            'month' => 'required|integer|min:1|max:12',
        ]);
    
        $file = $request->file('pdf');
        $filename = $file->getClientOriginalName();
    
        foreach ($request->input('plantel_ids') as $plantelId) {
            $plantel = Plantel::find($plantelId);
            if ($plantel) {
                $folderName = 'calendarios/' . Str::slug($plantel->name);
                $path = $file->storeAs($folderName, $filename, 'public');
    
                $pdf = new Pdf();
                $pdf->name = $filename;
                $pdf->file_path = $path;
                $pdf->pdfable_id = $request->input('education_level_id');
                $pdf->pdfable_type = EducationLevel::class;
                $pdf->save();
    
                // Guardar la asociación en la tabla pivot
                $pdf->educationLevels()->attach($request->input('education_level_id'), [
                    'plantel_id' => $plantelId,
                    'month' => $request->input('month')
                ]);
    
                // Log para confirmar que el PDF se asoció correctamente
                Log::info("PDF asociado correctamente: " . json_encode($pdf->educationLevels));
            }
        }
    
        return redirect()->route('admin.calendarios.index')->with('success', 'PDF subido correctamente.');
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($calendario)
    {
        $pdf = Pdf::with(['planteles', 'educationLevels'])->findOrFail($calendario);

        // Suponiendo que quieres el mes del primer plantel asociado
        $selectedMonth = optional($pdf->planteles->first())->pivot->month ?? null;

        $planteles = Plantel::all();
        $educationLevels = EducationLevel::all();
        $months = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
            5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
            9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];

        return view('admin.calendarios.edit', compact('pdf', 'planteles', 'educationLevels', 'months', 'selectedMonth'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $calendario)
    {
        $pdf = Pdf::findOrFail($calendario);
        $request->validate([
            'file_path' => 'nullable|file|mimes:pdf|max:10000',
            'education_level_id' => 'required|exists:education_levels,id',
            'plantel_ids' => 'required|array',
            'plantel_ids.*' => 'exists:plantels,id',
            'month' => 'required|integer|min:1|max:12',
        ]);

        if ($request->hasFile('file_path')) {
            if ($pdf->file_path && Storage::disk('public')->exists($pdf->file_path)) {
                Storage::disk('public')->delete($pdf->file_path);
            }

            $file = $request->file('file_path');
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
                'education_level_id' => $request->input('education_level_id'),
                'month' => $request->input('month')
            ];
        }
        $pdf->educationLevels()->sync($syncData);

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
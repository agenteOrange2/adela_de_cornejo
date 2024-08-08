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
    public function index(Request $request)
    {
        $level = $request->query('level');
        $search = $request->query('search');

        $pdfs = Pdf::with(['planteles', 'educationLevels'])
            ->whereHas('educationLevels', function ($query) use ($level) {
                if ($level && $level !== 'all') {
                    $query->where('name', $level);
                }
            })
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->latest('id')
            ->paginate();

        $educationLevels = EducationLevel::all();

        return view('admin.calendarios.index', compact('pdfs', 'educationLevels', 'level'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $planteles = Plantel::all();
        $educationLevels = EducationLevel::all();
        $schoolCycles = SchoolCycle::all(); // Asumiendo que tienes un modelo SchoolCycle
        $months = [
            'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
        ];
        return view('admin.calendarios.create', compact('planteles', 'educationLevels', 'schoolCycles', 'months'));
    }

    /**
     * Store a newly created resource in storage.
     **/

    public function store(Request $request)
    {
        $request->validate([
            'file_path' => 'required|file|mimes:pdf',
            'education_level_id' => 'required|exists:education_levels,id',
            'school_cycle_id' => 'required|exists:school_cycles,id',
            'plantel_ids' => 'required|array',
            'plantel_ids.*' => 'exists:plantels,id',
        ]);

        $file = $request->file('file_path');
        $filename = $file->getClientOriginalName(); // Respetar el nombre original del archivo

        // Procesar cada plantel seleccionado
        foreach ($request->input('plantel_ids') as $plantelId) {
            $plantel = Plantel::find($plantelId);
            if ($plantel) {
                $folderName = 'calendarios/' . Str::slug($plantel->name); // Carpeta por nombre de plantel
                $path = $file->storeAs($folderName, $filename, 'public'); // Guardar archivo en carpeta específica

                // Crear registro en la tabla pdfs
                $pdf = new Pdf();
                $pdf->name = $filename;
                $pdf->file_path = $path;
                $pdf->pdfable_id = $request->input('education_level_id'); // ID del nivel educativo
                $pdf->pdfable_type = EducationLevel::class; // O usa 'App\Models\EducationLevel' dependiendo de tu espacio de nombres
                $pdf->save();
                // Log para confirmar que el path se está guardando
                Log::info("Archivo guardado, ruta: " . $pdf->file_path);

                // Asociar PDF con el nivel educativo y plantel en la tabla pivot
                $pdf->educationLevels()->attach($request->input('education_level_id'), [
                    'plantel_id' => $plantelId,
                    'school_cycle_id' => $request->input('school_cycle_id'),
                    'month' => $request->input('month') // Añadir el ciclo escolar
                ]);
            }
        }


        Session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡PDF Subido con exito!',
            'text' => 'Se ha creado la categoría con éxito.',
        ]);
        return redirect()->route('admin.calendarios.index');
    }

    // CalendarController.php



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
        $schoolCycles = SchoolCycle::all();
        $months = [
            '1' => 'Enero', '2' => 'Febrero', '3' => 'Marzo', '4' => 'Abril',
            '5' => 'Mayo', '6' => 'Junio', '7' => 'Julio', '8' => 'Agosto',
            '9' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'
        ];

        return view('admin.calendarios.edit', compact('pdf', 'planteles', 'educationLevels', 'schoolCycles', 'months', 'selectedMonth'));
    }


    /**
     * Update the specified resource in storage.
     */
    /*
     public function update(Request $request, Pdf $pdf)
     {
         $request->validate([
             'file_path' => 'nullable|file|mimes:pdf|max:10000',
             'education_level_id' => 'required|exists:education_levels,id',
             'plantel_ids' => 'required|array',
             'plantel_ids.*' => 'exists:plantels,id',
         ]);

         // Obtenemos el primer ID de plantel y luego el plantel mismo
         $firstPlantelId = $request->input('plantel_ids')[0];
         $plantel = Plantel::find($firstPlantelId);

         if ($request->hasFile('file_path')) {
             if ($pdf->file_path && Storage::disk('public')->exists($pdf->file_path)) {
                 Storage::disk('public')->delete($pdf->file_path);
             }

             $file = $request->file('file_path');
             $filename = time() . '-' . $file->getClientOriginalName();
             $folderName = 'calendarios/' . Str::slug($plantel->name); // Usamos el nombre del plantel para la carpeta
             $path = $file->storeAs($folderName, $filename, 'public');
             $pdf->file_path = $path;
             $pdf->name = $filename; // Asegúrate de que tu tabla `pdfs` tiene una columna `name`
         }

         $pdf->pdfable_id = $request->input('education_level_id');
         $pdf->pdfable_type = 'App\Models\EducationLevel';
         $pdf->save();

         // Sincronización de la relación con planteles y niveles educativos
         $syncData = [];
         foreach ($request->input('plantel_ids') as $plantelId) {
             $syncData[$plantelId] = ['education_level_id' => $request->input('education_level_id')];
         }
         $pdf->planteles()->sync($syncData); // Asegúrate de que el modelo Pdf tiene definida la relación `planteles`

         return redirect()->route('admin.calendarios.index')->with('success', 'PDF actualizado correctamente.');
     }

*/
    public function update(Request $request, $calendario)
    {
        $pdf = Pdf::findOrFail($calendario);
        $request->validate([
            'file_path' => 'nullable|file|mimes:pdf|max:10000',
            'education_level_id' => 'required|exists:education_levels,id',
            'school_cycle_id' => 'required|exists:school_cycles,id',
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
                'school_cycle_id' => $request->input('school_cycle_id'),
                'month' => $request->input('month')
            ];
        }
        $pdf->planteles()->sync($syncData);

        return redirect()->route('admin.calendarios.index')->with('success', 'PDF actualizado correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        Log::info("Intentando eliminar el PDF con ID: " . $id);

        $pdf = Pdf::find($id);

        if (!$pdf) {
            Log::error("PDF con ID: $id no encontrado.");
            return redirect()->route('admin.calendarios.index')->with('error', 'PDF no encontrado.');
        }

        try {
            // Eliminar primero las asociaciones en la tabla pivote
            $pdf->educationLevels()->detach(); // Si estás usando relaciones many-to-many

            // Si existe un archivo asociado, intenta eliminarlo del storage
            if ($pdf->file_path && Storage::disk('public')->exists($pdf->file_path)) {
                Storage::disk('public')->delete($pdf->file_path);
            }

            // Elimina el PDF de la base de datos
            $pdf->delete();

            return redirect()->route('admin.calendarios.index')->with('success', 'PDF eliminado correctamente.');
        } catch (\Exception $e) {
            Log::error("Error al eliminar el PDF: " . $e->getMessage());
            return back()->with('error', 'Error al eliminar el PDF.');
        }
    }
}

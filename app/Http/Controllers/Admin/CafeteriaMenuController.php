<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pdf;
use App\Models\Plantel;
use App\Models\SchoolCycle;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MenuCafeteria;
use App\Models\EducationLevel;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CafeteriaMenuController extends Controller
{
/*
    public function index(Request $request)
    {
        $plantelId = $request->query('plantel');
        $month = $request->query('month');

        // Definición de los meses con nombres
        $months = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
            5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
            9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];

        // Asegúrate de que estás consultando correctamente los PDFs asociados a menús de cafetería
        $pdfs = Pdf::where('pdfable_type', MenuCafeteria::class)
            ->when($plantelId, function ($query) use ($plantelId) {
                $query->whereHas('plantelesForMenu', function ($q) use ($plantelId) {
                    $q->where('plantel_id', $plantelId);
                });
            })
            ->when($month, function ($query) use ($month) {
                $query->whereHas('plantelesForMenu', function ($q) use ($month) {
                    $q->where('menu_cafeteria_pdf.month', $month);
                });
            })
            ->latest('id')
            ->paginate();

        $planteles = Plantel::all();

        return view('admin.services.cafeteriamenu.index', compact('pdfs', 'planteles', 'plantelId', 'month', 'months'));
    }
*/

public function index(Request $request)
{
    $plantelId = $request->query('plantel');
    $month = $request->query('month');

    // Definición de los meses con nombres
    $months = [
        1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
        5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
        9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
    ];

    // Asegúrate de que estás consultando correctamente los PDFs asociados a menús de cafetería
    $pdfs = Pdf::where('pdfable_type', MenuCafeteria::class)
        ->when($plantelId, function ($query) use ($plantelId) {
            $query->whereHas('plantelesForMenu', function ($q) use ($plantelId) {
                $q->where('plantel_id', $plantelId);
            });
        })
        ->when($month, function ($query) use ($month) {
            $query->whereHas('plantelesForMenu', function ($q) use ($month) {
                $q->where('menu_cafeteria_pdf.month', $month);
            });
        })
        ->latest('id')
        ->paginate();

    $planteles = Plantel::all();
    $schoolCycles = SchoolCycle::all(); // Añadido para que esté disponible en la vista

    return view('admin.services.cafeteriamenu.index', compact('pdfs', 'planteles', 'plantelId', 'month', 'months', 'schoolCycles'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $planteles = Plantel::all();
        $schoolCycles = SchoolCycle::all(); // Asumiendo que tienes un modelo SchoolCycle
        $months = [
            'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
        ];
        return view('admin.services.cafeteriamenu.create', compact('planteles', 'schoolCycles', 'months'));
    }

    /**
     * Store a newly created resource in storage.
     */


     public function store(Request $request)
     {
         $request->validate([
             'pdf' => 'required|file|mimes:pdf',
             'school_cycle_id' => 'required|exists:school_cycles,id',
             'plantel_ids' => 'required|array',
             'plantel_ids.*' => 'exists:plantels,id',
             'month' => 'required|integer|min:1|max:12',
         ]);
     
         $file = $request->file('pdf');
         $originalName = $file->getClientOriginalName();
         
         // Formatear el nombre del archivo
         $formattedName = pathinfo($originalName, PATHINFO_FILENAME); // Obtener el nombre sin extensión
         $formattedName = preg_replace('/[^A-Za-z0-9\-]/', '', $formattedName); // Eliminar caracteres especiales
         $formattedName = str_replace(' ', '_', $formattedName); // Reemplazar espacios por guiones bajos
         $formattedName = Str::slug($formattedName); // Aplicar formato slug (eliminar acentos)
         $formattedName = $formattedName . '.' . $file->getClientOriginalExtension(); // Añadir la extensión de nuevo
     
         $year = now()->year; // Año actual
     
         foreach ($request->input('plantel_ids') as $plantelId) {
             $plantel = Plantel::find($plantelId);
             if ($plantel) {
                 $folderName = "menus/{$year}/" . Str::slug($plantel->name); // Año/Nombre del plantel
                 $path = $file->storeAs($folderName, $formattedName, 'public');
     
                 // Crear el registro PDF con todos los datos
                 $pdf = new Pdf();
                 $pdf->name = $formattedName;
                 $pdf->file_path = $path;
                 $pdf->pdfable_id = $plantel->id;
                 $pdf->pdfable_type = MenuCafeteria::class;
                 $pdf->save();
     
                 // Establecer la relación en la tabla pivote
                 $pdf->plantelesForMenu()->attach($plantelId, [
                     'school_cycle_id' => $request->input('school_cycle_id'),
                     'month' => $request->input('month')
                 ]);
             }
         }
     
         Session()->flash('swal', [
             'icon' => 'success',
             'title' => '¡PDF Agregado!',
             'text' => 'El archivo PDF se ha agregado con éxito al menú de cafetería.',
         ]);
     
         return redirect()->route('admin.menu-cafeteria.index');
     }



    public function edit($menu_cafeteria)
    {
        $pdf = Pdf::with('plantelesForMenu')->findOrFail($menu_cafeteria);

        // Suponiendo que quieres el mes del primer plantel asociado
        $selectedMonth = optional($pdf->plantelesForMenu->first())->pivot->month ?? null;

        // Suponiendo que quieres los meses de la tabla pivot para mostrarlos en la vista
        $planteles = Plantel::all();
        $schoolCycles = SchoolCycle::all();
        $months = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
            5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
            9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];

        return view('admin.services.cafeteriamenu.edit', compact('pdf', 'planteles', 'schoolCycles', 'months', 'selectedMonth'));
    }


    public function update(Request $request, $menu_cafeteria)
    {
        $pdf = Pdf::findOrFail($menu_cafeteria);
        $request->validate([
            'school_cycle_id' => 'required|exists:school_cycles,id',
            'plantel_ids' => 'required|array',
            'plantel_ids.*' => 'exists:plantels,id',
            'month' => 'required|integer|min:1|max:12',
            'pdf' => 'sometimes|file|mimes:pdf'
        ]);
    
        if ($request->hasFile('pdf')) {
            // Eliminar el archivo existente si hay uno nuevo
            if ($pdf->file_path && Storage::disk('public')->exists($pdf->file_path)) {
                Storage::disk('public')->delete($pdf->file_path);
            }
    
            $file = $request->file('pdf');
            $originalName = $file->getClientOriginalName();
            
            // Formatear el nombre del archivo
            $formattedName = pathinfo($originalName, PATHINFO_FILENAME); 
            $formattedName = preg_replace('/[^A-Za-z0-9\-]/', '', $formattedName);
            $formattedName = str_replace(' ', '_', $formattedName);
            $formattedName = Str::slug($formattedName); 
            $formattedName = $formattedName . '.' . $file->getClientOriginalExtension();
    
            $year = now()->year; 
    
            $plantel = Plantel::find($request->input('plantel_ids')[0]);
            if ($plantel) {
                $folderName = "menus/{$year}/" . Str::slug($plantel->name);
                $path = $file->storeAs($folderName, $formattedName, 'public');
                $pdf->file_path = $path;
                $pdf->name = $formattedName;
            }
        }
    
        $pdf->save();
    
        // Actualizar las relaciones en la tabla pivote
        $syncData = [];
        foreach ($request->input('plantel_ids') as $plantelId) {
            $syncData[$plantelId] = [
                'school_cycle_id' => $request->input('school_cycle_id'),
                'month' => $request->input('month')
            ];
        }
        $pdf->plantelesForMenu()->sync($syncData);
    
        return redirect()->route('admin.menu-cafeteria.index');
    }
    



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($menu_cafeteria)
    {
        $pdf = Pdf::findOrFail($menu_cafeteria);
    
        // Eliminar archivo físico
        if ($pdf->file_path && Storage::disk('public')->exists($pdf->file_path)) {
            Storage::disk('public')->delete($pdf->file_path);
        }
    
        // Eliminar el registro de la base de datos
        $pdf->delete();
    
        // Redireccionar con un mensaje de éxito
        return redirect()->route('admin.menu-cafeteria.index')->with('success', 'PDF eliminado correctamente.');
    }
}

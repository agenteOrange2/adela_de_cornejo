<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pdf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PdfController extends Controller
{
    public function index($plantel_id)
    {
        $pdfs = Pdf::where('plantel_id', $plantel_id)->get();
        return view('admin.planteles.pdfs.index', compact('pdfs', 'plantel_id'));
    }

    public function create($plantel_id)
    {
        return view('admin.planteles.pdfs.create', compact('plantel_id'));
    }

    public function store(Request $request, $plantel_id)
    {
        $request->validate([
            'name' => 'required|string',
            'file_path' => 'required|file',
            'plantel_id' => 'required|exists:plantels,id',
            'education_levels' => 'required|array',
            'education_levels.*' => 'exists:education_levels,id'
        ]);
    
        $pdf = new Pdf($request->only('name', 'file_path'));
        $pdf->plantel_id = $request->plantel_id;
        $pdf->save();
    
        $pdf->educationLevels()->sync($request->education_levels);
    
        return redirect()->route('admin.calendarios.index')->with('success', 'PDF agregado correctamente.');
    }

}

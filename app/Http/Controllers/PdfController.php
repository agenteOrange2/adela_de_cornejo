<?php

namespace App\Http\Controllers;

use App\Models\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'file' => 'required|file',
        'education_levels' => 'required|array',
        'planteles' => 'required|array',
    ]);

    $path = $request->file('file')->store('public/pdfs');

    $pdf = Pdf::create([
        'name' => $request->name,
        'file_path' => $path,
    ]);

    foreach ($request->education_levels as $levelId) {
        foreach ($request->planteles as $plantelId) {
            $pdf->education_levels()->attach($levelId, ['plantel_id' => $plantelId]);
        }
    }

    return back()->with('success', 'PDF cargado correctamente.');
}

}

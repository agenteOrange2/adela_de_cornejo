<?php

namespace App\Http\Controllers;

use App\Models\Pdf;
use App\Models\Plantel;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class OfertaController extends Controller
{

    public function showAdmissionPreescolar()
    {
        $levelId = 1; // ID de Preescolar
        return view('pages.admision-preescolar', compact('levelId'));
    }

    public function showAdmissionPrimaria()
    {
        $levelId = 2; // ID de Primaria
        return view('pages.admision-primaria', compact('levelId'));
    }

    public function showAdmissionSecundaria()
    {
        $levelId = 3; // ID de Secundaria
        return view('pages.admision-secundaria', compact('levelId'));
    }

public function getPdfsByPlantelAndLevel(Request $request)
{
    $plantelId = $request->query('plantel_id');
    $levelId = $request->query('level_id');

    // Revisar que ambos parámetros existen
    if (!$plantelId || !$levelId) {
        return response()->json(['error' => 'Faltan parámetros necesarios.'], 400);
    }

    // Obtener los PDFs filtrados por nivel educativo y plantel
    $pdfs = Pdf::whereHas('educationLevels', function ($query) use ($levelId) {
        $query->where('education_level_id', $levelId);
    })
    ->whereHas('planteles', function ($query) use ($plantelId) {
        $query->where('plantel_id', $plantelId);
    })
    ->orderBy('created_at', 'desc') // Ordenar por fecha de creación más reciente
    ->get();

    // Retornar los PDFs en formato JSON
    return response()->json($pdfs);
}
}


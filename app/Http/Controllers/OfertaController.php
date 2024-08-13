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

        $pdfs = QueryBuilder::for(Pdf::class)
            ->where('pdfable_type', 'App\Models\EducationLevel')
            ->where('pdfable_id', $levelId)
            ->whereHas('planteles', function ($query) use ($plantelId) {
                $query->where('plantel_id', $plantelId);
            })
            ->allowedSorts(['created_at']) // Permite ordenar por la fecha de creación
            ->defaultSort('-created_at') // Ordena por defecto desde el más reciente al más antiguo
            ->get();

        return response()->json($pdfs);
    }
}


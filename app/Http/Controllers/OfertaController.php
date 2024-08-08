<?php

namespace App\Http\Controllers;

use App\Models\Pdf;
use App\Models\Plantel;
use Illuminate\Http\Request;

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

        $pdfs = Pdf::where('pdfable_type', 'App\Models\EducationLevel')
            ->where('pdfable_id', $levelId)
            ->whereHas('planteles', function ($query) use ($plantelId) {
                $query->where('plantel_id', $plantelId);
            })
            ->get();

        return response()->json($pdfs);
    }
}


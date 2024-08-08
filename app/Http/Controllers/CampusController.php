<?php

namespace App\Http\Controllers;
use App\Models\Plantel;
use Illuminate\Http\Request;

class CampusController extends Controller
{
    public function showIvSiglos()
    {
        $plantel = Plantel::where('name', 'Plantel IV Siglos')->firstOrFail();
        return view('pages.campus.campus-iv-siglos', compact('plantel'));
    }

    public function showTriunfo()
    {
        $plantel = Plantel::where('name', 'Plantel Triunfo')->firstOrFail();
        return view('pages.campus.campus-triunfo', compact('plantel'));
    }
}

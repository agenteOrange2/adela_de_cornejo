<?php

namespace App\Http\Controllers;
use App\Models\Plantel;
use Illuminate\Http\Request;

class CafeteriaController extends Controller
{
    public function index()
    {
        $planteles = Plantel::with('menuPdf')->get();
        return view('pages.cafeteria', compact('planteles'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class AvisoController extends Controller
{
    public function index(){

        $avisos = Post::latest('id')->paginate(5);
        $avisos->each(function ($aviso) {
            $aviso->image_url = $aviso->image_path ? asset('storage/' . $aviso->image_path) : 'https://static.vecteezy.com/system/resources/previews/004/141/669/non_2x/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg';
        });        
        return view('pages.avisos', compact('avisos'));
    }

    public function show(Post $aviso)
    {
        // $aviso ya es el post actual, no necesitas buscarlo otra vez.
        $prevAviso = Post::where('id', '<', $aviso->id)->orderBy('id', 'desc')->first();
        $nextAviso = Post::where('id', '>', $aviso->id)->orderBy('id', 'asc')->first();

                // Procesar los nombres de los PDFs
                $pdfs = $aviso->pdfs->map(function ($pdf) {
                    $nameWithoutNumber = preg_replace('/^\d+-/', '', $pdf->name);
                    $nameWithoutExtension = pathinfo($nameWithoutNumber, PATHINFO_FILENAME);
                    $pdf->display_name = $nameWithoutExtension;
                    return $pdf;
                });
    
        return view('pages.singles.avisos.show', compact('aviso', 'prevAviso', 'nextAviso', 'pdfs'));
    }
    
}

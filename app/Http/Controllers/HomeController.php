<?php

namespace App\Http\Controllers;


use App\Models\Post;
use App\Models\Event;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        // Obtener sliders que están publicados
        $sliders = Slider::with('images')
            ->where('is_published', true)
            ->get();

        // Depuración: Verificar que se están recuperando las imágenes correctamente        

        $avisos = Post::where('is_published', true)->latest('id')->take(5)->get();
        $eventos = Event::where('is_published', true)->latest('id')->take(5)->get();

        // Agregar URL de imagen a los avisos y eventos
        $avisos->each(function ($aviso) {
            $aviso->image_url = $aviso->image_path ? asset('storage/' . $aviso->image_path) : 'https://static.vecteezy.com/system/resources/previews/004/141/669/non_2x/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg';
        });
        $eventos->each(function ($evento) {
            $evento->image_url = $evento->image_path ? asset('storage/' . $evento->image_path) : 'https://static.vecteezy.com/system/resources/previews/004/141/669/non_2x/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg';
        });

        // No es necesario agregar URL de imagen a los sliders aquí, ya que se hace en el modelo

        // Pasar sliders a la vista
        return view('pages.index', compact('sliders', 'avisos', 'eventos'));
    }
}

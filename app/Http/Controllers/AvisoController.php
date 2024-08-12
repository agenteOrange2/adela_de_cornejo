<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Plantel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class AvisoController extends Controller
{
    public function index(Request $request)
    {

        $filters = $request->input('filter', []);
        $sortField = $request->input('sort_field', 'published_at'); // Campo por defecto para ordenar
        $sortDirection = $request->input('sort_direction', 'desc'); // Dirección por defecto (descendente)

        // Asegúrate de que las fechas estén presentes y bien formateadas
        if (isset($filters['date_between'][0]) && isset($filters['date_between'][1])) {
            $startDate = Carbon::parse($filters['date_between'][0])->format('Y-m-d');
            $endDate = Carbon::parse($filters['date_between'][1])->format('Y-m-d');
                    
        } else {
            $startDate = null;
            $endDate = null;
        } 

        $avisos = QueryBuilder::for(Post::class)
            ->allowedFilters([
                AllowedFilter::exact('categories.id'),
                AllowedFilter::exact('planteles.id'),
                AllowedFilter::scope('date_between', 'whereDateBetween'),
                'title',
            ])->where(function ($query) use ($startDate, $endDate) {
                if ($startDate && $endDate) {
                    $query->whereBetween('published_at', [$startDate, $endDate]);
                }
            })
            ->where('is_published', true)
            ->orderBy($sortField, $sortDirection)
            ->paginate(5);

        $categories = PostCategory::withCount('posts')->get();
        $planteles = Plantel::all();

        // Manejando la URL de la imagen
        $avisos->each(function ($aviso) {
            $aviso->image_url = $aviso->image_path
                ? asset('storage/' . $aviso->image_path)
                : 'https://static.vecteezy.com/system/resources/previews/004/141/669/non_2x/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg';
        });

        return view('pages.avisos', compact('avisos', 'categories', 'planteles'));
    }

    public function show(Post $aviso)
    {
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

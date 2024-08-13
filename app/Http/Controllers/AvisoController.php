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
            ])
            ->where(function ($query) use ($startDate, $endDate) {
                if ($startDate && $endDate) {
                    $query->whereBetween('published_at', [$startDate, $endDate]);
                }
            })
            ->where('is_published', true)
            ->orderBy('id', 'desc') // Siempre ordenar por fecha de publicación, pero solo de los 5 primeros registros
            ->paginate(5);
    
        $categories = PostCategory::withCount('posts')->get();
        $planteles = Plantel::all();
    
        // Ordenar solo los 5 registros recuperados según el campo ID
        $avisos = $avisos->sortBy($sortDirection == 'asc' ? 'id' : 'id', SORT_REGULAR, $sortDirection == 'desc');
    
        return view('pages.avisos', compact('avisos', 'categories', 'planteles', 'sortDirection'));
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

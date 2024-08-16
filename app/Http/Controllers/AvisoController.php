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
        $user = auth()->user(); // Obtener el usuario autenticado, o null si no está autenticado
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
    
        // Modificar la consulta para filtrar por plantel del usuario autenticado, si está logueado
        $avisosQuery = QueryBuilder::for(Post::class)
            ->allowedFilters([
                AllowedFilter::exact('categories.id'),
                AllowedFilter::exact('planteles.id'),
                AllowedFilter::scope('date_between', 'whereDateBetween'),
                'title',
            ])
            ->where('is_published', true);
    
        if ($user) {
            // Si el usuario está autenticado, filtrar los avisos que pertenecen al plantel del usuario
            $avisosQuery->whereHas('planteles', function ($query) use ($user) {
                $query->where('plantel_id', $user->plantel_id);
            });
        }
    
        $avisos = $avisosQuery
            ->orderBy('id', $sortDirection == 'asc' ? 'asc' : 'desc')
            ->paginate(10);
    
        $categories = PostCategory::withCount('posts')->get();
        $planteles = Plantel::all();
    
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

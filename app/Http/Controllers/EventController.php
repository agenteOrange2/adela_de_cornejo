<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Plantel;
use Illuminate\Http\Request;
use App\Models\EventCategory;
use Illuminate\Support\Carbon;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class EventController extends Controller
{
    public function index(Request $request)
    {        
        $filters = $request->input('filter', []);

        // Asegúrate de que las fechas estén presentes y bien formateadas
        if (isset($filters['date_between'][0]) && isset($filters['date_between'][1])) {
            $startDate = Carbon::parse($filters['date_between'][0])->format('Y-m-d');
            $endDate = Carbon::parse($filters['date_between'][1])->format('Y-m-d');
                    
        } else {
            $startDate = null;
            $endDate = null;
        }        

        $eventos = QueryBuilder::for(Event::class)
        ->allowedFilters([
            AllowedFilter::exact('eventCategories.id'),  // Filtro por categoría
            AllowedFilter::exact('planteles.id'),  // Filtro por plantel
            AllowedFilter::scope('date_between', 'whereDateBetween'),  // Filtro por rango de fechas
            'title',  // Filtro por título
        ])
        ->where(function ($query) use ($startDate, $endDate) {
            if ($startDate && $endDate) {
                $query->whereBetween('published_at', [$startDate, $endDate]);
            }
        })
            ->where('is_published', true)
            ->latest('id')
            ->paginate(5);    

        $categories = EventCategory::withCount('events')->get();
        $planteles = Plantel::all();
        $latestEventos = Event::where('is_published', true)->latest('id')->take(5)->get();

        return view('pages.eventos', compact('eventos', 'categories', 'latestEventos', 'planteles'));
    }


    public function show(Event $evento)
    {
        $bannerImage = $evento->banner ? $evento->banner->path : null;
        $prevEvento = Event::where('id', '<', $evento->id)->orderBy('id', 'desc')->first();
        $nextEvento = Event::where('id', '>', $evento->id)->orderBy('id', 'asc')->first();
        $videos = $evento->videos;
        $galleryImages = $evento->images;

        // Pasar la imagen para los metadatos
        $metaImage = $evento->image_path ? asset('storage/' . $evento->image_path) : asset('default-image-path.jpg');

        return view('pages.singles.events.show', compact('evento', 'prevEvento', 'nextEvento', 'bannerImage', 'videos', 'galleryImages', 'metaImage'));
    }

    public function category($id)
    {
        $eventos = QueryBuilder::for(Event::class)
            ->allowedFilters([AllowedFilter::exact('eventCategories.id')])
            ->whereHas('eventCategories', function ($query) use ($id) {
                $query->where('event_category_id', $id);
            })
            ->where('is_published', true)
            ->paginate(10);

        $categories = EventCategory::withCount('events')->get();
        $planteles = Plantel::all();
        $latestEventos = Event::where('is_published', true)->latest('id')->take(5)->get();

        return view('pages.eventos', compact('eventos', 'categories', 'latestEventos', 'planteles'));
    }

    public function plantel($id)
    {
        $eventos = QueryBuilder::for(Event::class)
            ->allowedFilters([AllowedFilter::exact('planteles.id')])
            ->whereHas('planteles', function ($query) use ($id) {
                $query->where('plantel_id', $id);
            })
            ->where('is_published', true)
            ->paginate(10);

        $categories = EventCategory::withCount('events')->get();
        $planteles = Plantel::all();
        $latestEventos = Event::where('is_published', true)->latest('id')->take(5)->get();

        return view('pages.eventos', compact('eventos', 'categories', 'latestEventos', 'planteles'));
    }
}

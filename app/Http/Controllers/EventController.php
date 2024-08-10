<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Plantel;
use Illuminate\Http\Request;
use App\Models\EventCategory;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $eventos = QueryBuilder::for(Event::class)
            ->allowedFilters([
                AllowedFilter::exact('categories.id'), // Filtro por categoría
                AllowedFilter::exact('planteles.id'),  // Filtro por plantel
                AllowedFilter::scope('date_between', 'whereDateBetween'), // Filtro por rango de fechas
                'title',
            ])
            ->where('is_published', true)
            ->latest('id')
            ->paginate(5);

        $categories = EventCategory::withCount('events')->get();
        $planteles = Plantel::all(); // Asegúrate de tener este modelo correctamente configurado
        $latestEventos = Event::where('is_published', true)->latest('id')->take(5)->get();

        return view('pages.eventos', compact('eventos', 'categories', 'latestEventos', 'planteles'))
            ->with('paginatorView', 'vendor.pagination.custom');
    }


    public function show(Event $evento)
    {
        $bannerImage = $evento->banner ? $evento->banner->path : null;
        $prevEvento = Event::where('id', '<', $evento->id)->orderBy('id', 'desc')->first();
        $nextEvento = Event::where('id', '>', $evento->id)->orderBy('id', 'asc')->first();
        $videos = $evento->videos;
        $galleryImages = $evento->images;

        return view('pages.singles.events.show', compact('evento', 'prevEvento', 'nextEvento', 'bannerImage', 'videos', 'galleryImages'));
    }

    public function category($id)
    {
        $eventos = QueryBuilder::for(Event::class)
            ->allowedFilters([
                AllowedFilter::exact('eventCategories.id'),
                'title',
            ])
            ->whereHas('eventCategories', function ($query) use ($id) {
                $query->where('event_category_id', $id);
            })
            ->where('is_published', true)
            ->paginate(5);
    
        $categories = EventCategory::withCount('events')->get();
        $planteles = Plantel::all();
        $latestEventos = Event::where('is_published', true)->latest('id')->take(5)->get();
    
        return view('pages.eventos', compact('eventos', 'categories', 'latestEventos', 'planteles'));
    }

public function plantel($id)
{
    $eventos = QueryBuilder::for(Event::class)
        ->allowedFilters([
            AllowedFilter::exact('planteles.id'),
            'title',
        ])
        ->whereHas('planteles', function ($query) use ($id) {
            $query->where('plantel_id', $id);
        })
        ->where('is_published', true)
        ->paginate(5);

    $categories = EventCategory::withCount('events')->get();
    $planteles = Plantel::all();
    $latestEventos = Event::where('is_published', true)->latest('id')->take(5)->get();

    return view('pages.eventos', compact('eventos', 'categories', 'latestEventos', 'planteles'));
}
}

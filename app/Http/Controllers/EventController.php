<?php

namespace App\Http\Controllers;

use App\Models\Event;
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
                AllowedFilter::exact('categories.id'), // Utilizando 'categories.id' como nombre del filtro
                'title',
            ])
            ->where('is_published', true)
            ->latest('id')
            ->paginate(5);

        $categories = EventCategory::withCount('events')->get();
        $latestEventos = Event::where('is_published', true)->latest('id')->take(5)->get();

        return view('pages.eventos', compact('eventos', 'categories', 'latestEventos'))
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
}
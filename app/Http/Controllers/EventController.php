<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\EventCategory;

class EventController extends Controller
{
    public function index()
    {        
        $eventos = Event::where('is_published', true)->latest('id')->paginate(5);
        //dd($eventos);
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
        $videos = $evento->videos; // Cargar los videos relacionados
        $galleryImages = $evento->images; // Cargar las imágenes de la galería
    
        return view('pages.singles.events.show', compact('evento', 'prevEvento', 'nextEvento','bannerImage','videos', 'galleryImages'));
    }


    public function category($id)
    {
        $category = EventCategory::findOrFail($id);
        $eventos = Event::whereHas('categories', function ($query) use ($id) {
            $query->where('event_category_id', $id);
        })->where('is_published', true)->latest('id')->paginate(5);
        $categories = EventCategory::withCount('events')->get();
        $latestEventos = Event::where('is_published', true)->latest('id')->take(5)->get();

        return view('pages.eventos', compact('eventos', 'categories', 'category', 'latestEventos'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $eventos = Event::where('title', 'like', "%$query%")->where('is_published', true)->latest('id')->paginate(5);
        $categories = EventCategory::withCount('events')->get();
        $latestEventos = Event::where('is_published', true)->latest('id')->take(5)->get();

        return view('pages.eventos', compact('eventos', 'categories', 'latestEventos'));
    }

    public function ajaxSearch(Request $request)
    {
        $query = $request->input('query');
        $eventos = Event::where('title', 'like', "%$query%")->where('is_published', true)->latest('id')->get();
    
        $eventos->each(function ($evento) {
            $evento->image_url = $evento->image_url;
            $evento->show_url = route('eventos.show', $evento);
        });
    
        return response()->json(['eventos' => $eventos]);
    }
    
}

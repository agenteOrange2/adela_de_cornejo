<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\Image;
use App\Models\Plantel;
use Illuminate\Http\Request;
use App\Models\EventCategory;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $eventos = Event::latest('id')->paginate(5);
        return view('admin.events.index', compact('eventos'));
    }

    public function create()
    {
        $categories = EventCategory::all();
        $planteles = Plantel::all();
        return view('admin.events.create', compact('categories', 'planteles'));
    }


    public function store(Request $request)
    {

        //return dd($request->all());
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:events,slug',
            'excerpt' => 'nullable',
            'description' => 'required',
            'image' => 'nullable|image',
            'banner' => 'nullable|image',
            'gallery_files' => 'nullable|array',
            'gallery_files.*' => 'nullable|image|', // Limita el tamaño a 400 KB
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'is_published' => 'required|boolean',
            'location' => 'nullable|string',
            'type' => 'nullable|string',
            'status' => 'nullable|string',
            'event_category_ids' => 'required|array',
            'event_category_ids.*' => 'exists:event_categories,id',
            'video_urls' => 'nullable|array',
            'video_urls.*' => 'nullable|url',
            'plantel_ids' => 'required|array',
            'plantel_ids.*' => 'exists:plantels,id',

        ]);

        $evento = new Event($request->except(['image', 'gallery_files', 'banner']));
        $evento->user_id = auth()->id(); // Asegura que el ID del usuario autenticado se asigna al evento        
        $evento->date = $request->date;
        $evento->start_time = $request->date . ' ' . $request->start_time . ':00'; // Combinar fecha y hora
        $evento->end_time = $request->date . ' ' . $request->end_time . ':00'; // Combinar fecha y hora
        $evento->is_published = $request->boolean('is_published');

        if ($evento->is_published) {
            $evento->published_at = now();
        }

        $evento->save();
        //Asignar categorias
        $evento->eventCategories()->sync($request->event_category_ids);
        $evento->planteles()->sync($request->plantel_ids);

        // Guardar la imagen principal
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME); // Extraer solo el nombre sin extensión
            $extension = $image->getClientOriginalExtension(); // Extensión del archivo

            // Crear un nombre de archivo con un prefijo único (ID del evento si está disponible o timestamp)
            $filename = $evento->id . '-' . $originalName . '.' . $extension;
            $path = $image->storeAs('events/' . $evento->id, $filename, 'public');

            $evento->image_path = $path;
            $evento->save();
        }

        // Guardar la imagen del banner
        if ($request->hasFile('banner')) {
            $banner = $request->file('banner');
            $originalName = pathinfo($banner->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $banner->getClientOriginalExtension();

            // Crear un nombre de archivo con un prefijo único (ID del evento si está disponible o timestamp)
            $filename = $originalName . '.' . $extension;
            $path = $banner->storeAs('events/' . $evento->id . '/banner', $filename, 'public');

            // Guardar en la tabla polimórfica
            $evento->images()->create([
                'path' => $path,
                'imageable_id' => $evento->id,
                'imageable_type' => Event::class
            ]);
        }

        // Guardar imágenes de la galería si existen
        if ($request->hasFile('gallery_files')) {
            foreach ($request->file('gallery_files') as $file) {
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();

                // Crear un nombre de archivo con un prefijo único (ID del evento si está disponible o timestamp)
                $filename = $originalName . '.' . $extension;
                $path = $file->storeAs('events/' . $evento->id . '/gallery', $filename, 'public');

                // Guardar en la tabla polimórfica
                $evento->images()->create([
                    'path' => $path,
                    'imageable_id' => $evento->id,
                    'imageable_type' => Event::class
                ]);
            }
        }


        // Guardar URLs de videos si existen
        if ($request->video_urls) {
            foreach ($request->video_urls as $video_url) {
                if (!empty($video_url)) {
                    $evento->videos()->create([
                        'url' => $video_url,
                        'videoable_id' => $evento->id,
                        'videoable_type' => Event::class
                    ]);
                }
            }
        }

        Session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Evento Creado!',
            'text' => 'El evento se ha creado con éxito.',
        ]);

        return redirect()->route('admin.eventos.index');
    }

    public function edit(Event $evento)
    {

        $evento->load('banner', 'images');
        $categories = EventCategory::all();
        $videos = $evento->videos()->get();
        $planteles = Plantel::all();
        $selectedPlanteles = $evento->planteles->pluck('id')->toArray();
        //dd($evento->date, $evento->start_time, $evento->end_time);
        return view('admin.events.edit', compact('evento', 'categories', 'videos', 'planteles', 'selectedPlanteles'));
    }

    public function update(Request $request, Event $evento)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:events,slug,' . $evento->id,
            'excerpt' => 'nullable',
            'description' => 'required',
            'image' => 'nullable|image',
            'banner' => 'nullable|image',
            'gallery_files' => 'nullable|array',
            'gallery_files.*' => 'nullable|image|', // Limita el tamaño a 400 KB
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'is_published' => 'required|boolean',
            'location' => 'nullable|string',
            'type' => 'nullable|string',
            'status' => 'nullable|string',
            'event_category_ids' => 'required|array',
            'event_category_ids.*' => 'exists:event_categories,id',
            'video_urls.*' => 'nullable|url',
            'plantel_ids' => 'required|array',
            'plantel_ids.*' => 'exists:plantels,id',
        ]);

        // Formatear fecha y hora con la fecha proporcionada
        $evento->date = $request->date;
        $evento->start_time = $request->date . ' ' . $request->start_time . ':00';
        $evento->end_time = $request->date . ' ' . $request->end_time . ':00';
        $evento->user_id = auth()->id(); // Actualiza con el usuario autenticado

        $evento->is_published = $request->boolean('is_published');
        if ($evento->is_published && !$evento->published_at) {
            $evento->published_at = now();
        }

        $evento->fill($request->except(['image', 'banner', 'gallery_files', 'date', 'start_time', 'end_time', 'video_urls', 'user_id']));
        $evento->planteles()->sync($request->plantel_ids);


        // Guardar la imagen principal
        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($evento->image_path && Storage::exists($evento->image_path)) {
                Storage::delete($evento->image_path);
            }

            $image = $request->file('image');
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $filename = $evento->id . '-' . $originalName . '.' . $extension;
            $path = $image->storeAs('events/' . $evento->id, $filename, 'public');
            $evento->image_path = $path;
        }

        // Guardar la imagen del banner
        if ($request->hasFile('banner')) {
            // Eliminar banner anterior si existe
            $oldBanner = $evento->images()->where('path', 'LIKE', '%/banner/%')->first();
            if ($oldBanner && Storage::exists('public/' . $oldBanner->path)) {
                Storage::delete('public/' . $oldBanner->path);
                $oldBanner->delete();
            }

            $banner = $request->file('banner');
            $originalName = pathinfo($banner->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $banner->getClientOriginalExtension();
            $filename = $originalName . '.' . $extension;
            $path = $banner->storeAs('events/' . $evento->id . '/banner', $filename, 'public');

            // Guardar en la tabla polimórfica
            $evento->images()->create([
                'path' => $path,
                'imageable_id' => $evento->id,
                'imageable_type' => Event::class
            ]);
        }

        // Guardar imágenes de la galería si existen
        if ($request->hasFile('gallery_files')) {
            foreach ($request->file('gallery_files') as $file) {
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $filename = $originalName . '.' . $extension;
                $path = $file->storeAs('events/' . $evento->id . '/gallery', $filename, 'public');

                // Guardar en la tabla polimórfica
                $evento->images()->create([
                    'path' => $path,
                    'imageable_id' => $evento->id,
                    'imageable_type' => Event::class
                ]);
            }
        }

        // Sincronizar categorías
        $evento->eventCategories()->sync($request->event_category_ids);

        // Manejo de videos
        $currentUrls = $evento->videos->pluck('url')->toArray();
        $newUrls = array_filter($request->video_urls ?: []); // Elimina elementos nulos o vacíos

        // Eliminar videos que no están en los nuevos URLs
        foreach ($evento->videos as $video) {
            if (!in_array($video->url, $newUrls)) {
                $video->delete();
            }
        }

        // Agregar o actualizar los nuevos URLs
        foreach ($newUrls as $url) {
            if (!in_array($url, $currentUrls)) {
                $evento->videos()->create(['url' => $url]);
            }
        }

        $evento->save();
        Session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Evento Actualizado!',
            'text' => 'El evento se ha actualizado con éxito.',
        ]);

        return redirect()->route('admin.eventos.index');
    }


    public function destroyImage(Event $evento, Image $image)
    {
        try {
            Log::info("Intentando eliminar imagen con ID: {$image->id} para el evento con ID: {$evento->id}");

            if ($evento->images()->find($image->id)) {
                $imagePath = storage_path('app/public/' . $image->path);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $image->delete();
                return response()->json(['success' => true, 'message' => 'Imagen eliminada correctamente.']);
            } else {
                return response()->json(['success' => false, 'message' => 'Imagen no encontrada en este evento.'], 404);
            }
        } catch (\Exception $e) {
            Log::error('Error al eliminar la imagen: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Ocurrió un error al eliminar la imagen.'], 500);
        }
    }

    public function destroy(Event $evento)
    {
        // Intentar eliminar el directorio de imágenes asociado al evento
        $directory = 'events/' . $evento->id;
        if (Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->deleteDirectory($directory);
        }

        $evento->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Evento Eliminado!',
            'text' => 'Se elimino el evento con éxito.',
        ]);

        return redirect()->route('admin.eventos.index');
    }
}

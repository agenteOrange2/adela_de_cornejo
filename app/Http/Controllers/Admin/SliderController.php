<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;


class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::with('images')->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        // Validar y guardar el slider
        $request->validate([
            'title' => 'required|string|max:255',
            'paragraph' => 'required|string',
            'link' => 'nullable|url',
            'image' => 'required|image',
            'image_tablet' => 'nullable|image',
            'image_mobile' => 'nullable|image',
        ]);

        $slider = Slider::create($request->only(['title', 'paragraph', 'link']));
        $slider->is_published = $request->boolean('is_published');
        if ($slider->is_published) {
            $slider->published_at = now();
        }
        $slider->save();

        // Crear una instancia de ImageManager con el controlador deseado (Imagick en este caso)
        $manager = new ImageManager(new Driver());

        $folderPath = 'public/sliders/' . $slider->id . '/';

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME); // Extraer solo el nombre sin extensión
            $extension = $file->getClientOriginalExtension();

            // Formatear el nombre del archivo
            $filename = $slider->id . '-' . $originalName . '-1920.' . $extension;
            $path = $file->storeAs($folderPath, $filename);

            // Optimizar imagen
            $imagePath = storage_path('app/' . $folderPath . $filename);
            $img = $manager->read($imagePath);

            // Redimensionar si es necesario y ajustar la calidad
            $img->resize(1920, 1080, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($imagePath, 75); // Ajusta la calidad según sea necesario

            // Guardar la ruta en la base de datos sin el prefijo 'public/'
            $slider->images()->create(['path' => 'sliders/' . $slider->id . '/' . $filename]);
        }

        if ($request->hasFile('image_tablet')) {
            $file = $request->file('image_tablet');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME); // Extraer solo el nombre sin extensión
            $extension = $file->getClientOriginalExtension();

            // Formatear el nombre del archivo
            $filename = $slider->id . '-' . $originalName . '-1024.' . $extension;
            $path = $file->storeAs($folderPath, $filename);

            // Optimizar imagen
            $imagePath = storage_path('app/' . $folderPath . $filename);
            $img = $manager->read($imagePath);

            // Redimensionar si es necesario y ajustar la calidad
            $img->resize(1024, 768, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($imagePath, 75); // Ajusta la calidad según sea necesario

            // Guardar la ruta en la base de datos sin el prefijo 'public/'
            $slider->images()->create(['path' => 'sliders/' . $slider->id . '/' . $filename]);
        }

        if ($request->hasFile('image_mobile')) {
            $file = $request->file('image_mobile');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME); // Extraer solo el nombre sin extensión
            $extension = $file->getClientOriginalExtension();

            // Formatear el nombre del archivo
            $filename = $slider->id . '-' . $originalName . '-375.' . $extension;
            $path = $file->storeAs($folderPath, $filename);

            // Optimizar imagen
            $imagePath = storage_path('app/' . $folderPath . $filename);
            $img = $manager->read($imagePath);

            // Redimensionar si es necesario y ajustar la calidad
            $img->resize(375, 667, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($imagePath, 75); // Ajusta la calidad según sea necesario

            // Guardar la ruta en la base de datos sin el prefijo 'public/'
            $slider->images()->create(['path' => 'sliders/' . $slider->id . '/' . $filename]);
        }

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Slider Creado!',
            'text' => 'Slider creado exitosamente.',
        ]);

        return redirect()->route('admin.sliders.index');
    }


    public function edit($id)
    {
        $slider = Slider::with('images')->findOrFail($id);
        // $slider = Slider::findOrFail($id);
        return view('admin.sliders.edit', compact('slider'));
    }
    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'paragraph' => 'required|string',
            'link' => 'nullable|url',
            'is_published' => 'required|boolean',
            'image' => 'nullable|image',
            'image_tablet' => 'nullable|image',
            'image_mobile' => 'nullable|image',
        ]);

        $slider->update($request->only(['title', 'paragraph', 'link']));

        // Manejo del campo is_published
        $slider->is_published = $request->boolean('is_published');
        if ($slider->is_published && !$slider->published_at) {
            $slider->published_at = now();
        } elseif (!$slider->is_published) {
            $slider->published_at = null; // Opcionalmente, podemos anular published_at si se despublica
        }

        $slider->save();

        $manager = new ImageManager(new Driver());
        $folderPath = 'public/sliders/' . $slider->id . '/';

        function handleImageUpdate($request, $imageField, $size, $folderPath, $manager, $slider)
        {
            if ($request->hasFile($imageField)) {
                $oldImage = $slider->images()->where('path', 'like', '%-' . $size . '.%')->first();
                if ($oldImage && Storage::exists('public/' . $oldImage->path)) {
                    Storage::delete('public/' . $oldImage->path);
                    $oldImage->delete();
                }

                $file = $request->file($imageField);
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $filename = $slider->id . '-' . $originalName . '-' . $size . '.' . $extension;
                $path = $file->storeAs($folderPath, $filename);

                $imagePath = storage_path('app/' . $folderPath . $filename);
                $img = $manager->read($imagePath);
                [$width, $height] = explode('x', $size);
                $img->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save($imagePath, 75);

                $slider->images()->create([
                    'path' => 'sliders/' . $slider->id . '/' . $filename,
                ]);
            }
        }

        handleImageUpdate($request, 'image', '1920x1080', $folderPath, $manager, $slider);
        handleImageUpdate($request, 'image_tablet', '1024x768', $folderPath, $manager, $slider);
        handleImageUpdate($request, 'image_mobile', '375x667', $folderPath, $manager, $slider);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Slider Actualizado!',
            'text' => 'Slider actualizado exitosamente.',
        ]);

        return redirect()->route('admin.sliders.index');
    }



    public function destroy($id)
    {
        $slider = Slider::with('images')->findOrFail($id);
    
        // Eliminar todas las imágenes asociadas
        foreach ($slider->images as $image) {
            if (Storage::exists('public/' . $image->path)) {
                Storage::delete('public/' . $image->path);  // Elimina el archivo del almacenamiento
            }
            $image->delete();  // Elimina el registro de la imagen de la base de datos
        }
    
        // Eliminar el directorio del slider
        $folderPath = 'public/sliders/' . $slider->id;
        if (Storage::exists($folderPath)) {
            Storage::deleteDirectory($folderPath);  // Elimina el directorio completo
        }
    
        // Eliminar el slider
        $slider->delete();
    
        return redirect()->route('admin.sliders.index')->with('success', 'Slider eliminado con éxito.');
    }
}

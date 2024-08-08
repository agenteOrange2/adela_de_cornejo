<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pdf;
use App\Models\Plantel;
use App\Models\MenuCafeteria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class PlantelController extends Controller
{
    public function show($id)
    {
        $plantel = Plantel::findOrFail($id);
        $pdfs = Pdf::where('pdfable_type', MenuCafeteria::class)
                    ->whereHas('plantelesForMenu', function ($query) use ($plantel) {
                        $query->where('plantel_id', $plantel->id);
                    })
                    ->get();

        return view('admin.planteles.show', compact('plantel', 'pdfs'));
    }

    public function edit($id)
    {
        $plantel = Plantel::findOrFail($id);
        $pdfs = Pdf::where('pdfable_type', MenuCafeteria::class)
                    ->whereHas('plantelesForMenu', function ($query) use ($plantel) {
                        $query->where('plantel_id', $plantel->id);
                    })
                    ->get();

        return view('admin.planteles.edit', compact('plantel', 'pdfs'));
    }

    public function update(Request $request, $id)
    {
        $plantel = Plantel::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'description' => 'required',
            'image' => 'nullable|image|max:2048',
            'pdf_id' => 'nullable|exists:pdfs,id',
            'video_urls.*' => 'nullable|url',
        ]);

        $plantel->update($request->except(['image', 'pdf_id']));

        if ($request->hasFile('image')) {
            // Eliminar imagen antigua si existe
            if ($plantel->image_path && Storage::disk('public')->exists($plantel->image_path)) {
                Storage::disk('public')->delete($plantel->image_path);
            }

            $image = $request->file('image');
            $imageName = $plantel->id . '-' . $image->getClientOriginalName();
            $imagePath = $image->storeAs("planteles/{$plantel->name}", $imageName, 'public');
            $plantel->image_path = $imagePath;
        }

        // Actualizar el PDF seleccionado
        $plantel->menu_pdf_id = $request->input('pdf_id', null);

        // Manejo de videos
        $currentUrls = $plantel->videos->pluck('url')->toArray();
        $newUrls = array_filter($request->video_urls ?: []); // Elimina elementos nulos o vacíos

        // Eliminar videos que no están en los nuevos URLs
        foreach ($plantel->videos as $video) {
            if (!in_array($video->url, $newUrls)) {
                $video->delete();
            }
        }

        // Agregar o actualizar los nuevos URLs
        foreach ($newUrls as $url) {
            if (!in_array($url, $currentUrls)) {
                $plantel->videos()->create(['url' => $url]);
            }
        }

        

        $plantel->save();

        Session::flash('success', 'Plantel actualizado correctamente.');

        return redirect()->route('admin.planteles.show', $plantel->id);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pdf;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Plantel;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $avisos = Post::latest('id')->paginate(5);
        return view('admin.posts.index', compact('avisos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = PostCategory::all();
        $planteles = Plantel::all();
        return view('admin.posts.create', compact('categories', 'planteles'));
    }


    public function store(Request $request)
    {

        //dd($request->all());
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:posts',
            'excerpt' => 'nullable',
            'body' => 'required',
            'image' => 'nullable|image',
            'pdf_files' => 'nullable|array',
            'pdf_files.*' => 'file|mimes:pdf,doc,docx,xls,xlsx|max:10000',
            'categories' => 'required|array',
            'categories.*' => 'exists:post_categories,id',
            'plantel_ids' => 'required|array',
            'plantel_ids.*' => 'exists:plantels,id',
        ]);

        $post = new Post($request->except(['image', 'pdf_files', 'categories', 'plantel_ids']));
        $post->user_id = auth()->id();        
        $post->is_published = $request->boolean('is_published');
        if ($post->is_published) {
            $post->published_at = now();
        }
        $post->save();

        // Asignar categorías
        $post->planteles()->sync($request->plantel_ids);
        $post->categories()->sync($request->categories);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $post->id . '-' . $image->getClientOriginalName();
            $imagePath = $image->storeAs("avisos/{$post->id}/images", $imageName, 'public');
            $post->image_path = $imagePath;
            $post->save();
        }

        if ($request->hasFile('pdf_files')) {
            foreach ($request->file('pdf_files') as $pdf) {
                $pdfName = $post->id . '-' . $pdf->getClientOriginalName();
                $pdfPath = $pdf->storeAs("avisos/{$post->id}/pdf", $pdfName, 'public');

                $pdfRecord = new Pdf([
                    'name' => $pdfName,
                    'file_path' => $pdfPath,
                    'pdfable_id' => $post->id,
                    'pdfable_type' => Post::class
                ]);
                $pdfRecord->save();
            }
        }


        Session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Aviso Creado!',
            'text' => 'El Aviso se creó con éxito.'
        ]);

        return redirect()->route('admin.avisos.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $aviso)
    {
        $categories = PostCategory::all();
        $selectedCategories = $aviso->categories->pluck('id')->toArray();
        $pdfs = $aviso->pdfs;
        $planteles = Plantel::all();
        $selectedPlanteles = $aviso->planteles->pluck('id')->toArray();
        return view('admin.posts.edit', compact('aviso', 'categories', 'selectedCategories', 'pdfs', 'planteles', 'selectedPlanteles'));     
    }

    public function update(Request $request, Post $aviso)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:posts,slug,' . $aviso->id,
            'excerpt' => $request->is_published ? 'required' : 'nullable',
            'body' => $request->is_published ? 'required' : 'nullable',
            'is_published' => 'required|boolean',
            'tags' => 'nullable|array',
            'image' => 'nullable|image',
            'categories' => 'required|array',
            'pdf_files' => 'nullable|array',
            'pdf_files.*' => 'file|mimes:pdf,doc,docx,xls,xlsx|max:10000',
            'categories.*' => 'exists:post_categories,id',
            'plantel_ids' => 'required|array',
            'plantel_ids.*' => 'exists:plantels,id',
        ]);

        // Manejo de tags
        $tags = collect($request->tags ?? [])->map(function ($name) {
            return Tag::firstOrCreate(['name' => $name])->id;
        })->all();

        $aviso->tags()->sync($tags);

        // Actualizar la información del post
        $aviso->update($request->only(['title', 'slug', 'excerpt', 'body', 'is_published']));
        // Asignar categorías
        $aviso->categories()->sync($request->categories);
        $aviso->planteles()->sync($request->plantel_ids);
        
        // Manejo de la imagen
        if ($request->hasFile('image')) {
            // Eliminar imagen antigua si existe
            if ($aviso->image_path) {
                Storage::disk('public')->delete($aviso->image_path);
            }

            // Subir la nueva imagen
            $image = $request->file('image');
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $filename = $aviso->id . '-' . $originalName . '.' . $extension;
            $path = $image->storeAs('avisos/' . $aviso->id . '/images', $filename, 'public');
            $aviso->image_path = $path;
        }


        // Manejo de archivos PDF
        if ($request->hasFile('pdf_files')) {
            foreach ($request->file('pdf_files') as $file) {
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $filename = $aviso->id . '-' . $originalName . '.' . $extension;
                $path = $file->storeAs('avisos/' . $aviso->id . '/pdf', $filename, 'public');

                // Guardar cada PDF en la base de datos
                $pdf = new Pdf([
                    'name' => $filename,
                    'file_path' => $path,
                    'pdfable_id' => $aviso->id,
                    'pdfable_type' => Post::class,
                ]);
                $pdf->save();
            }
        }
        
        $aviso->save();

        Session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡aviso Actualizado!',
            'text' => 'La aviso se actualizó con éxito.',
        ]);

        return redirect()->route('admin.avisos.index');
    }



    /**
     * Remove the specified resource from storage.
     */
    
    public function destroyPdf(Pdf $pdf)
    {
        try {
            Storage::disk('public')->delete($pdf->file_path);
            $pdf->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false], 500);
        }

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡PDF Eliminado!',
            'text' => 'Se elimino el pdf con éxito.',
        ]);
        return back();
    }

    public function destroy(Post $aviso)
    {
        // Eliminar imagen si existe
        if ($aviso->image_path) {
            Storage::disk('public')->delete($aviso->image_path);
        }

        // Eliminar PDFs asociados
        foreach ($aviso->pdfs as $pdf) {
            Storage::disk('public')->delete($pdf->file_path);
            $pdf->delete();
        }

        // Eliminar la aviso
        $aviso->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡aviso Eliminada!',
            'text' => 'Se elimino la aviso con éxito.',
        ]);

        return redirect()->route('admin.avisos.index');
    }
}

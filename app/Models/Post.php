<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'image_path',
        'user_id',
        'is_published',        
    ];

    protected function title(): Attribute
    {
        return new Attribute(
            set: fn ($value) => strtolower($value),
            get: fn ($value) => ucfirst($value),
        );
    }

    public function getImageUrlAttribute()
    {
        if ($this->image_path) {
            return asset('avisos/' . $this->image_path);
        }
        return 'https://i.postimg.cc/prsHzgwn/adeladecornejo-predeterminado.webp';  // O un enlace a una imagen por defecto si lo prefieres
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->image_path) {
                    if (str_starts_with($this->image_path, 'http') || str_starts_with($this->image_path, 'https')) {
                        return $this->image_path; // Retorna la URL completa si ya está completa
                    }
                    // Asegura que se añade 'storage/' solo si no está ya incluido
                    $pathPrefix = str_starts_with($this->image_path, 'storage/') ? '' : 'storage/';
                    return asset($pathPrefix . $this->image_path);
                }
                // Enlace a una imagen por defecto
                return 'https://i.postimg.cc/prsHzgwn/adeladecornejo-predeterminado.webp';
            }
        );
    }
    
    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->isoFormat('D MMMM, YYYY');
    }

    //Relacion uno a muchos inversa
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Relacion muchos a muchos polimorfica
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function categories()
    {
        return $this->belongsToMany(PostCategory::class, 'post_post_category');
    }


    public function pdfs()
    {
        return $this->morphMany(Pdf::class, 'pdfable');
    }

    public function planteles()
    {
        return $this->belongsToMany(Plantel::class, 'plantel_post');
    }

        //Route Model Binding
        public function getRouteKeyName(){
            return 'slug';
    }

}

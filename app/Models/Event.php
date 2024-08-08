<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'description',
        'image_path',
        'date',
        'start_time',
        'end_time',
        'location',
        'maps',
        'organizer',
        'status',
        'type',
        'user_id',
        'is_published',
        'plantel_id',

    ];

    protected $dates = ['date', 'start_time', 'end_time'];

    // Modifica los accesores para simplificar y asegurar la conversión
    public function getStartTimeAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('H:i') : null;
    }

    public function getEndTimeAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('H:i') : null;
    }


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
            return asset('storage/' . $this->image_path);
        }
        return 'https://i.postimg.cc/prsHzgwn/adeladecornejo-predeterminado.webp';  // O un enlace a una imagen por defecto si lo prefieres
    }

    protected function image(): Attribute
    {
        return Attribute::make(

            get: function () {
                if ($this->image_path) {
                    if (str_starts_with($this->image_path, 'http') || str_starts_with($this->image_path, 'https')) {
                        return $this->image_path;
                    }
                    return asset('storage/' . $this->image_path);
                } else {
                    return 'https://i.postimg.cc/prsHzgwn/adeladecornejo-predeterminado.webp';
                }
            }
        );
    }

    // Accessor para formatear la fecha en español
    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->date)->isoFormat('D MMMM, YYYY');
    }

    // Accessor para formatear la hora de inicio en español
    public function getFormattedStartTimeAttribute()
    {
        return Carbon::parse($this->start_time)->isoFormat('h:mm A');
    }

    // Accessor para formatear la hora de fin en español
    public function getFormattedEndTimeAttribute()
    {
        return Carbon::parse($this->end_time)->isoFormat('h:mm A');
    }

    // Accessor para formatear la fecha de creación en español
    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->isoFormat('D MMMM, YYYY');
    }

    protected static function boot()
    {
        parent::boot();

        // Eliminar todos los videos asociados automáticamente cuando se elimina un Evento
        static::deleting(function ($event) {
            // Eliminar todos los videos asociados
            $event->videos()->delete();

            // Opcional: Eliminar el directorio de imágenes asociado

            /*$directory = 'events/' . $event->id;
            if (Storage::disk('public')->exists($directory)) {
                Storage::disk('public')->deleteDirectory($directory);
            }*/
        });
    }


    /* ARELACIONES ELOQUENT  */

    public function eventCategories()
    {
        return $this->belongsToMany(EventCategory::class, 'event_event_category', 'event_id', 'event_category_id');
    }


    public function categories()
    {
        return $this->belongsToMany(EventCategory::class, 'event_event_category');
    }

    public function educationLevel()
    {
        return $this->belongsTo(EducationLevel::class);
    }

    public function banner()
    {
        return $this->morphOne(Image::class, 'imageable')->where('path', 'LIKE', '%/banner/%');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable')->where('path', 'LIKE', '%/gallery/%');
    }


    public function videos()
    {
        return $this->morphMany(Video::class, 'videoable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function planteles()
    {
        return $this->belongsToMany(Plantel::class, 'plantel_event');
    }

    //Route Model Binding
    public function getRouteKeyName()
    {
        return 'slug';
    }
}

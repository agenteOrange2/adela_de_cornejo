<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plantel extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'phone', 'email', 'description', 'image_path', 'location', 'menu_pdf_id'];
    protected $table = 'plantels'; // Asegurarse de que el nombre de la tabla esté correcto

    public function menuPdf()
    {
        return $this->belongsTo(Pdf::class, 'menu_pdf_id');
    }

    public function educationLevels()
    {
        return $this->belongsToMany(EducationLevel::class, 'education_level_pdf')
                    ->withPivot('pdf_id', 'school_cycle_id', 'month');
    }

    public function pdfs()
    {
        return $this->morphMany(Pdf::class, 'pdfable');
    }

    public function schoolCycles()
    {
        return $this->belongsToMany(SchoolCycle::class, 'education_level_pdf')
                    ->withPivot('education_level_id', 'month');
    }


    public function videos()
    {
        return $this->morphMany(Video::class, 'videoable');
    }


    public function posts()
    {
        return $this->belongsToMany(Post::class, 'plantel_post');
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'plantel_event');
    }
}

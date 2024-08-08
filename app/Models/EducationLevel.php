<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationLevel extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];

    public function pdfs()
    {
        return $this->morphMany(Pdf::class, 'pdfable');
    }

    public function schoolCycles()
    {
        return $this->belongsToMany(SchoolCycle::class, 'education_level_pdf');
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}

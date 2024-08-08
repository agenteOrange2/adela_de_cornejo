<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pdf extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'file_path', 'pdfable_id', 'pdfable_type'];

    public function pdfable()
    {
        return $this->morphTo();
    }

    public function plantelesForMenu()
    {
        return $this->belongsToMany(Plantel::class, 'menu_cafeteria_pdf')
        ->withPivot('school_cycle_id', 'month');
    }

    public function plantel()
    {
        return $this->belongsTo(Plantel::class);
    }

    public function educationLevels()
    {
        return $this->belongsToMany(EducationLevel::class, 'education_level_pdf');
    }

    public function planteles()
    {
        return $this->belongsToMany(Plantel::class, 'education_level_pdf')
            ->withPivot('education_level_id', 'school_cycle_id', 'month');
    }

    public function schoolCycle()
    {
        return $this->belongsTo(SchoolCycle::class);
    }
}

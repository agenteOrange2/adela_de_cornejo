<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolCycle extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'start_date', 'end_date'];

    // Asegúrate de que las fechas sean tratadas como instancias de Carbon
    protected $dates = ['start_date', 'end_date'];
    
    public function getStartDateFormattedAttribute()
    {
        return Carbon::parse($this->start_date)->format('l, d F Y');
    }

    public function getEndDateFormattedAttribute()
    {
        return Carbon::parse($this->end_date)->format('l, d F Y');
    }


    public function pdfs()
    {
        return $this->belongsToMany(Pdf::class, 'education_level_pdf');
    }
}

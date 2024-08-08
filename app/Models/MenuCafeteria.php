<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuCafeteria extends Model
{
    use HasFactory;

    public $fillable = ['name']; // Asegúrate de ajustar los campos según necesites

    public function pdfs()
    {
        return $this->morphMany(Pdf::class, 'pdfable');
    }
}

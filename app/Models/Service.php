<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public function educationLevel()
    {
        return $this->belongsTo(EducationLevel::class);
    }
}

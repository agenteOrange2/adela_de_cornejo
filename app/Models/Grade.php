<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'education_level_id'];

    public function educationLevel()
    {
        return $this->belongsTo(EducationLevel::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}

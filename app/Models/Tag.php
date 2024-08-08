<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    //Relacion muchos a muchos polimorfica inversa
    public function posts(){
        return $this->morphedByMany(Post::class, 'taggable');
    }
}

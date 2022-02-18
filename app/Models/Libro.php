<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;

    protected $fillable = ['isbn', 'nombre', 'categoria_id', 'editorial', 'imagen'];

    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    public function autores(){
        // Crear modelo para autores??
    }
}

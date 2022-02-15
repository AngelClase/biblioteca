<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;

    protected $fillable = ['isbn', 'nombre', 'categoria_id', 'editorial', 'imagen'];

    public function categoria_id(){
        $this->hasMany(Categoria::class);
    }

    public function autores(){
        // Crear modelo para autores??
    }
}

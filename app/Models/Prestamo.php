<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

    protected $fillable = ['libro_id', 'user_id', 'fecha_plazo', 'fecha_entrega'];

    public function libro_id(){
        $this->hasOne(Libro::class);
    }

    public function user_id(){
        $this->hasOne(User::class);
    }
}

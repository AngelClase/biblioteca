<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sancion extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'fecha_inicio', 'retraso'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}

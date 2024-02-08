<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Usuario extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'tipo_usuario_id'];

    protected $attributes = [
        'tipo_usuario_id' => 2
    ];
}

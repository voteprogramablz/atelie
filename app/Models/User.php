<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Enums\TipoUsuario;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'tipo_usuario',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'tipo_usuario' => TipoUsuario::class,
    ];

    // Helper methods for role checking
    public function isAdmin(): bool
    {
        return $this->tipo_usuario === TipoUsuario::ADMINISTRADOR;
    }

    public function isCostureira(): bool
    {
        return $this->tipo_usuario === TipoUsuario::COSTUREIRA;
    }
}
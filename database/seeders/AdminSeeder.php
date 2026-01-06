<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Enums\TipoUsuario;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Only create admin if it doesn't exist
        if (User::where('tipo_usuario', TipoUsuario::ADMINISTRADOR)->count() === 0) {
            User::create([
                'name' => env('ADMIN_NAME', 'Administrator'),
                'email' => env('ADMIN_EMAIL', 'admin@example.com'),
                'password' => Hash::make(env('ADMIN_PASSWORD', 'changeme123!')),
                'tipo_usuario' => TipoUsuario::ADMINISTRADOR,
                'email_verified_at' => now(),
            ]);
        }
    }
}
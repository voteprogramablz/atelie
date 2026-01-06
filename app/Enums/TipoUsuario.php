<?php

namespace App\Enums;

enum TipoUsuario: int
{
    case ADMINISTRADOR = 1;
    case COSTUREIRA = 2;

    public function label(): string
    {
        return match($this) {
            self::ADMINISTRADOR => 'Administrador',
            self::COSTUREIRA => 'Costureira',
        };
    }

    public static function fromLabel(string $label): self
    {
        return match(strtolower($label)) {
            'administrador', 'admin' => self::ADMINISTRADOR,
            'costureira' => self::COSTUREIRA,
            default => throw new \ValueError("Tipo de usuário inválido: $label")
        };
    }
}
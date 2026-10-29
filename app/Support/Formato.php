<?php

namespace App\Support;

class Formato
{
    public static function cop(float|int|string|null $valor): string
    {
        return '$ '.number_format((float) $valor, 0, ',', '.');
    }

    public static function numero(float|int|string|null $valor, int $decimales = 0): string
    {
        return number_format((float) $valor, $decimales, ',', '.');
    }
}

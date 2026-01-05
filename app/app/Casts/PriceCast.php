<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class PriceCast implements CastsAttributes
{
    /**
     * Преобразование при извлечении данных из БД (для приложения).
     * $value - это значение из БД (в копейках).
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        // Преобразуем целое число из БД в дробное (рубли)
        return $value / 100;
    }

    /**
     * Преобразование перед записью данных в БД.
     * $value - это значение, установленное в модель (в рублях).
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        // Преобразуем входящее значение (рубли) в целое число (копейки)
        // Используем round для защиты от ошибок округления при арифметических операциях
        return (int) round($value * 100);
    }

    public static function format($value)
    {
        // Ваша логика форматирования цены
        return number_format($value, 2, '.', '');
    }
}

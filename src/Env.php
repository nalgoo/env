<?php
declare(strict_types=1);

namespace Nalgoo\Env;

class Env
{
	public static function get(string $name, mixed $default = null): mixed
	{
		if (!array_key_exists($name, $_ENV)) {
			return $default;
		}

		return $_ENV[$name];
	}

	public static function getBool(string $name, ?bool $default = null): ?bool
	{
		return filter_var(static::get($name, $default), FILTER_VALIDATE_BOOL, FILTER_NULL_ON_FAILURE);
	}

	public static function getNumber(string $name, int | float | null $default = null): int | float | null
	{
		$number = static::get($name, $default);

		if (is_numeric($number)) {
			if (preg_match('/^\s*0|[1-9][0-9]*(_[0-9]+)*\s*$/', $number)) {
				return (int) $number;
			}

			return (float) $number;
		}

		return null;
	}
}

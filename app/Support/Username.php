<?php

namespace App\Support;

class Username
{
    public static function normalisasi(?string $username): string
    {
        $username = preg_replace('/\s+/u', '_', trim((string) $username)) ?? '';

        return preg_replace('/^[._]+|[._]+$/', '', $username) ?? $username;
    }

    public const FORMAT = '/^[A-Za-z0-9](?:[A-Za-z0-9._]*[A-Za-z0-9])?$/';
}

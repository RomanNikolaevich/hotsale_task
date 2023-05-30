<?php

namespace App\Config;

class PathConfig
{
    public static function getLogFilePath(): string
    {
        return '/var/storage/logs/project/registration.log';
    }

    public static function getDatabaseFilePath(): string
    {
        return '/var/storage/database/project/users.json';
    }

    public static function getTemplatePath(): string
    {
        return __DIR__ . '/../Views';
    }

    public static function getTokenPath(): string
    {
        return 'registration-form';
    }
}

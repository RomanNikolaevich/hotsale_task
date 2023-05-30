<?php

namespace App\Services;

use App\Config\PathConfig;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;

class LoggerService
{
    public function logSuccess($email): void
    {
        $logFilePath = PathConfig::getLogFilePath();

        $this->createLogFile($logFilePath);

        $log = new Logger('registration');
        $log->pushHandler(new StreamHandler($logFilePath, Level::Info));
        $log->info('Пользователь зарегистрирован', ['email' => $email]);

    }

    private function createLogFile(string $logFilePath): void
    {
        if (!file_exists($logFilePath)) {
            file_put_contents($logFilePath, '');
        }
    }
}

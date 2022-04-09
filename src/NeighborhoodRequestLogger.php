<?php

namespace Balsama\BostonNeighborhoodFinder;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\JsonFormatter;

class NeighborhoodRequestLogger
{
    private Logger $log;
    private StreamHandler $stream;

    public function __construct()
    {
        $this->log = new Logger('channel_name');
        $formatter = new JsonFormatter();
        $this->stream = new StreamHandler(__DIR__.'/../application_logs/application-json.log', Logger::DEBUG);
        $this->stream->setFormatter($formatter);

        $this->log->pushHandler($this->stream);
    }

    public function logRequest(string $message, array $context)
    {
        $this->log->info($message, $context);
    }
}
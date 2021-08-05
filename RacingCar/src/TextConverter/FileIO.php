<?php

declare(strict_types=1);

namespace RacingCar\TextConverter;

class FileIO
{

    /** @var resource */
    protected $handler;

    public function open(string $filename, string $mode): void
    {
        $this->handler = fopen($filename, $mode);
    }

    /**
     * @return string|false
     */
    public function readLine()
    {
        return fgets($this->handler);
    }
}

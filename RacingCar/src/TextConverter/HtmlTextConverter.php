<?php

declare(strict_types=1);

namespace RacingCar\TextConverter;

class HtmlTextConverter
{
    private $fullFileNameWithPath;
    private FileIO $fileIO;

    public function __construct(string $fullFileNameWithPath, ?FileIO $fileIO = null)
    {
        $this->fullFileNameWithPath = $fullFileNameWithPath;
        $this->fileIO = $fileIO ?? new FileIO();
    }

    public function convertToHtml(): string
    {
        $this->fileIO->open($this->fullFileNameWithPath, 'r');

        $html = '';
        while (($line = $this->fileIO->readLine()) !== false) {
            $line = rtrim($line);
            $html .= htmlspecialchars($line, ENT_QUOTES | ENT_HTML5);
            $html .= '<br />';
        }
        return $html;
    }

    public function getFileName()
    {
        return $this->fullFileNameWithPath;
    }
}

<?php

declare(strict_types=1);

namespace Tests\TextConverter;

use PHPUnit\Framework\TestCase;
use RacingCar\TextConverter\FileIO;
use RacingCar\TextConverter\HtmlTextConverter;

class HtmlTextConverterTest extends TestCase
{

    public function testFileName(): void
    {
        $fileHandlerMock = $this->createMock(FileIO::class);
        $fileName = 'foo';
        $converter = new HtmlTextConverter($fileName, $fileHandlerMock);
        $this->assertSame($fileName, $converter->getFileName());
    }

    public function testSpecialChar(): void
    {
        $fileHandlerMock = $this->createMock(FileIO::class);
        $fileHandlerMock->expects(self::once())->method('open');
        $fileHandlerMock->expects(self::exactly(2))->method('readLine')->willReturn(
            '\'', false
        );
        $converter = new HtmlTextConverter('foo', $fileHandlerMock);
        
        self::assertSame('&apos;<br />', $converter->convertToHtml());
    }
}

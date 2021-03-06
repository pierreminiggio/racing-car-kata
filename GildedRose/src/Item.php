<?php

declare(strict_types=1);

namespace GildedRose;

final class Item
{
    public string $name;
    public int $sellIn;
    public int $quality;

    public function __construct(string $name, int $sellIn, int $quality)
    {
        $this->name = $name;
        $this->sellIn = $sellIn;
        $this->quality = $quality;
    }

    public function __toString(): string
    {
        return "{$this->name}, {$this->sellIn}, {$this->quality}";
    }
}

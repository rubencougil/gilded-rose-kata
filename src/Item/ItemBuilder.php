<?php

declare(strict_types=1);

namespace GildedRose\Item;

class ItemBuilder
{
    private ?string $name = null;
    private ?int $sellIn = null;
    private ?int $quality = null;

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setSellIn(int $sellIn): self
    {
        $this->sellIn = $sellIn;
        return $this;
    }

    public function setQuality(int $quality): self
    {
        $this->quality = $quality;
        return $this;
    }

    public function build(): Item
    {
        if ($this->name === null || $this->sellIn === null || $this->quality === null) {
            throw new \InvalidArgumentException('All properties must be set before building the item.');
        }

        return new Item($this->name, $this->sellIn, $this->quality);
    }
}

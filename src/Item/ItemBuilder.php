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
        if (!$this->name) {
            throw new \InvalidArgumentException('Item name is required');
        }

        if ($this->sellIn === null) {
            throw new \InvalidArgumentException('Item sellIn is required');
        }

        if ($this->quality === null || $this->quality < 0) {
            throw new \InvalidArgumentException('Item quality is required and must be greater than or equal to 0');
        }

        return new Item($this->name, $this->sellIn, $this->quality);
    }
}

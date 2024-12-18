<?php

namespace GildedRose\Updater;

use GildedRose\Item\Item;

abstract class ItemUpdater implements Updater
{
    protected Item $item;

    /**
     * @param Item $item
     */
    public function __construct(Item $item)
    {
        $this->item = $item;
        $this->validate();
    }

    public function validate(): void
    {
        if ($this->item->quality < 0 || $this->item->quality > 50) {
            throw new \InvalidArgumentException('Quality must be between 0 and 50');
        }
    }

    public function update(): void
    {
        $this->decreaseQuality();
        $this->decreaseSellIn();
    }

    /**
     * @return void
     */
    protected function decreaseQuality(): void
    {
        if ($this->item->quality > 0) {
            --$this->item->quality;
        }
    }

    /**
     * @return void
     */
    protected function increaseQuality(): void
    {
        if ($this->item->quality < 50) {
            ++$this->item->quality;
        }
    }

    /**
     * @return void
     */
    protected function decreaseSellIn(): void
    {
        --$this->item->sellIn;
    }
}

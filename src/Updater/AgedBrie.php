<?php

namespace GildedRose\Updater;

class AgedBrie extends ItemUpdater implements Updater
{
    public function update(): void
    {
        $this->increaseQuality();
        $this->increaseQuality();
        if ($this->item->sellIn < 0) {
            $this->increaseQuality();
        }
        $this->decreaseSellIn();
    }
}

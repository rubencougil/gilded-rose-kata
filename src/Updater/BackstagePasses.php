<?php

namespace GildedRose\Updater;

class BackstagePasses extends ItemUpdater implements Updater
{
    public function update(): void
    {
        $this->increaseQuality();
        if ($this->item->sellIn < 11) {
            $this->increaseQuality();
        }
        if ($this->item->sellIn < 6) {
            $this->increaseQuality();
        }
        if ($this->item->sellIn < 0) {
            $this->item->quality = 0;
        }

        $this->decreaseSellIn();
    }
}

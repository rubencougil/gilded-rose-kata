<?php

namespace GildedRose\Updater;

class Conjured extends ItemUpdater implements Updater
{

    public function update(): void
    {
        $this->decreaseQuality();
        $this->decreaseQuality();
        $this->decreaseSellIn();
    }
}

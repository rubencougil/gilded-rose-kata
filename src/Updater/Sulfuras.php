<?php

namespace GildedRose\Updater;

class Sulfuras extends ItemUpdater
{
    public function validate(): void
    {
        if ($this->item->quality !== 80) {
            throw new \InvalidArgumentException('Quality must be 80');
        }
    }

    public function update(): void
    {
    }
}

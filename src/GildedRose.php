<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Item\Item;
use GildedRose\Updater\UpdaterFactory;

final class GildedRose
{
    /**
     * @var Item[]
     */
    private array $items;

    /**
     * @param Item[] $items
     */
    public function __construct(array $items) {
        $this->items = $items;
    }

    /**
     * @return Item[]
     */
    public function updateQuality(): array
    {
        foreach ($this->items as $item) {
            UpdaterFactory::create($item)->update();
        }
        return $this->items;
    }
}

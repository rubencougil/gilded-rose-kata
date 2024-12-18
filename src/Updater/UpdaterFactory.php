<?php

namespace GildedRose\Updater;

use GildedRose\Item\Item;

class UpdaterFactory
{
    private const AGED_BRIE = 'Aged Brie';
    private const BACKSTAGE_PASSES = 'Backstage passes to a TAFKAL80ETC concert';
    private const SULFURAS = 'Sulfuras, Hand of Ragnaros';
    private const CONJURED = 'Conjured';

    public static function create(Item $item): Updater
    {
        return match ($item->name) {
            self::AGED_BRIE => new AgedBrie($item),
            self::BACKSTAGE_PASSES => new BackstagePasses($item),
            self::SULFURAS => new Sulfuras($item),
            self::CONJURED => new Conjured($item),
            default => new Standard($item),
        };
    }
}

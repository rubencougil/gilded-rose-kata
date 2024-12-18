<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item\ItemBuilder;
use http\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function itemProvider(): array
    {
        return [
            'Aged Brie' => [
                'name' => 'Aged Brie',
                'sellIn' => 0,
                'quality' => 0,
                'expectedSellIn' => -1,
                'expectedQuality' => 2,
            ],
            'Aged Brie past sell date' => [
                'name' => 'Aged Brie',
                'sellIn' => -1,
                'quality' => 0,
                'expectedSellIn' => -2,
                'expectedQuality' => 3,
            ],
            'Sulfuras' => [
                'name' => 'Sulfuras, Hand of Ragnaros',
                'sellIn' => 1,
                'quality' => 80,
                'expectedSellIn' => 1,
                'expectedQuality' => 80,
            ],
            'Backstage passes' => [
                'name' => 'Backstage passes to a TAFKAL80ETC concert',
                'sellIn' => 15,
                'quality' => 20,
                'expectedSellIn' => 14,
                'expectedQuality' => 21,
            ],
            'Unknown Item' => [
                'name' => 'Unknown Item',
                'sellIn' => 10,
                'quality' => 20,
                'expectedSellIn' => 9,
                'expectedQuality' => 19,
            ],
            'Backstage passes after concert' => [
                'name' => 'Backstage passes to a TAFKAL80ETC concert',
                'sellIn' => -1,
                'quality' => 20,
                'expectedSellIn' => -2,
                'expectedQuality' => 0,
            ],
            'Backstage passes 10 days or less' => [
                'name' => 'Backstage passes to a TAFKAL80ETC concert',
                'sellIn' => 10,
                'quality' => 20,
                'expectedSellIn' => 9,
                'expectedQuality' => 22,
            ],
            'Backstage passes 5 days or less' => [
                'name' => 'Backstage passes to a TAFKAL80ETC concert',
                'sellIn' => 5,
                'quality' => 20,
                'expectedSellIn' => 4,
                'expectedQuality' => 23,
            ],
            'Standard Item quality never negative' => [
                'name' => 'Standard Item',
                'sellIn' => 0,
                'quality' => 0,
                'expectedSellIn' => -1,
                'expectedQuality' => 0,
            ],
            'Aged Brie quality never more than 50' => [
                'name' => 'Aged Brie',
                'sellIn' => 2,
                'quality' => 50,
                'expectedSellIn' => 1,
                'expectedQuality' => 50,
            ],
            'Sulfuras never decreases in quality' => [
                'name' => 'Sulfuras, Hand of Ragnaros',
                'sellIn' => 0,
                'quality' => 80,
                'expectedSellIn' => 0,
                'expectedQuality' => 80,
            ],
            'Conjured Item' => [
                'name' => 'Conjured',
                'sellIn' => 10,
                'quality' => 20,
                'expectedSellIn' => 9,
                'expectedQuality' => 18,
            ],
        ];
    }

    /**
     * @dataProvider itemProvider
     */
    public function testItem(string $name, int $sellIn, int $quality, int $expectedSellIn, int $expectedQuality): void
    {
        $items = [
            (new ItemBuilder())
                ->setName($name)
                ->setSellIn($sellIn)
                ->setQuality($quality)
                ->build()
        ];
        $gildedRose = new GildedRose($items);
        $itemsUpdated = $gildedRose->updateQuality();
        $this->assertSame($name, $itemsUpdated[0]->name);
        $this->assertSame($expectedQuality, $itemsUpdated[0]->quality);
        $this->assertSame($expectedSellIn, $itemsUpdated[0]->sellIn);
    }

    public function invalidItemProvider(): array
    {
        return [
            'Negative quality' => [
                'name' => 'Standard Item',
                'sellIn' => 10,
                'quality' => -1,
            ],
            'Quality over 50' => [
                'name' => 'Aged Brie',
                'sellIn' => 10,
                'quality' => 51,
            ],
            'Empty name' => [
                'name' => '',
                'sellIn' => 10,
                'quality' => 20,
            ],
            'Sulfuras has to be quality 80' => [
                'name' => 'Sulfuras, Hand of Ragnaros',
                'sellIn' => 10,
                'quality' => 79,
            ]
        ];
    }

    /**
     * @dataProvider invalidItemProvider
     */
    public function testInvalidItem(string $name, int $sellIn, int $quality): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $items = [
            (new ItemBuilder())
                ->setName($name)
                ->setSellIn($sellIn)
                ->setQuality($quality)
                ->build()
        ];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
    }
}

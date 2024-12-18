<?php

namespace GildedRose\Updater;

interface Updater
{
    public function update(): void;
    public function validate(): void;
}

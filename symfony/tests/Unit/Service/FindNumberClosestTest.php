<?php

declare(strict_types=1);

namespace App\tests\Unit\Service;

use App\Service\FindNumberClosest;
use PHPUnit\Framework\TestCase;

class FindNumberClosestTest extends TestCase
{
    private array $array = [
        1 => 'items ',
        4 => 'items ',
        5 => 'items ',
        9 => 'items ',
        10 => 'items ',
        40 => 'items ',
        50 => 'items ',
        90 => 'items ',
        100 => 'items ',
        500 => 'items ',
        1000 => 'items ',
    ];

    public function testGetKeyNumberClosest()
    {
        $findNumberClosest = new FindNumberClosest();
        $this->assertEquals(10, $findNumberClosest->getKeyNumberClosestAndSmallest(15, $this->array));
        $this->assertEquals(5, $findNumberClosest->getKeyNumberClosestAndSmallest(7, $this->array));
        $this->assertEquals(5, $findNumberClosest->getKeyNumberClosestAndSmallest(8, $this->array));
        $this->assertEquals(10, $findNumberClosest->getKeyNumberClosestAndSmallest(30, $this->array));
        $this->assertEquals(500, $findNumberClosest->getKeyNumberClosestAndSmallest(800, $this->array));
    }
}

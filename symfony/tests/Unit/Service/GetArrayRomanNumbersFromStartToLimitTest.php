<?php

declare(strict_types=1);

namespace App\tests\Unit\Service;

use App\Service\FindNumberClosest;
use App\Service\GetArrayRomanNumbersFromStartToLimit;
use App\Service\RomanNumberConverter;
use PHPUnit\Framework\TestCase;

class GetArrayRomanNumbersFromStartToLimitTest extends TestCase
{
    private $getRomanNumberWithArabicNumber;

    protected function setUp(): void
    {
        $romanConvertor = new RomanNumberConverter(new FindNumberClosest());

        $this->getRomanNumberWithArabicNumber = new GetArrayRomanNumbersFromStartToLimit($romanConvertor);
    }

    public function testGetRomanNumberFromStartToLimit()
    {
        $expected = [
           ['arabic ' => 1, 'roman' => 'I'],
           ['arabic ' => 2, 'roman' => 'II'],
           ['arabic ' => 3, 'roman' => 'III'],
           ['arabic ' => 4, 'roman' => 'IV'],
           ['arabic ' => 5, 'roman' => 'V'],
           ['arabic ' => 6, 'roman' => 'VI'],
           ['arabic ' => 7, 'roman' => 'VII'],
           ['arabic ' => 8, 'roman' => 'VIII'],
           ['arabic ' => 9, 'roman' => 'IX'],
       ];

        $response = $this->getRomanNumberWithArabicNumber->createArrayConvertedNumber(1, 10, 1);

        $this->assertEquals($expected, $response);
    }
}

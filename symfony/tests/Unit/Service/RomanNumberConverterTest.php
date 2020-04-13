<?php

declare(strict_types=1);

namespace App\tests\Unit\Service;

use App\Service\FindNumberClosest;
use App\Service\RomanNumberConverter;
use PHPUnit\Framework\TestCase;

class RomanNumberConverterTest extends TestCase
{
    private $romainConvertor;

    protected function setUp(): void
    {
        $this->romainConvertor = new RomanNumberConverter(new FindNumberClosest());
    }

    public function testCallClass()
    {
        $this->assertEquals('App\Service\RomanNumberConverter', RomanNumberConverter::class);
    }

    public function testConvert0ToRomanNumberWillReturnEmpty()
    {
        $this->assertEquals('', $this->romainConvertor->convertArabicToRoman(0));
    }

    public function testConvertToRomanNumberEachUniqueSymbol()
    {
        $this->assertEquals('I', $this->romainConvertor->convertArabicToRoman(1));
        $this->assertEquals('V', $this->romainConvertor->convertArabicToRoman(5));
        $this->assertEquals('X', $this->romainConvertor->convertArabicToRoman(10));
        $this->assertEquals('L', $this->romainConvertor->convertArabicToRoman(50));
        $this->assertEquals('C', $this->romainConvertor->convertArabicToRoman(100));
        $this->assertEquals('D', $this->romainConvertor->convertArabicToRoman(500));
        $this->assertEquals('M', $this->romainConvertor->convertArabicToRoman(1000));
    }

    public function testConvertArabicNumberWithConcatRomanNumber()
    {
        $this->assertEquals('II', $this->romainConvertor->convertArabicToRoman(2));
        $this->assertEquals('VII', $this->romainConvertor->convertArabicToRoman(7));
        $this->assertEquals('LXXX', $this->romainConvertor->convertArabicToRoman(80));
        $this->assertEquals('CC', $this->romainConvertor->convertArabicToRoman(200));
        $this->assertEquals('CCV', $this->romainConvertor->convertArabicToRoman(205));
    }

    public function testConvertArabicNumberToRomanNumberException()
    {
        $this->assertEquals('IV', $this->romainConvertor->convertArabicToRoman(4));
        $this->assertEquals('IX', $this->romainConvertor->convertArabicToRoman(9));
        $this->assertEquals('XIV', $this->romainConvertor->convertArabicToRoman(14));
        $this->assertEquals('XC', $this->romainConvertor->convertArabicToRoman(90));
        $this->assertEquals('CD', $this->romainConvertor->convertArabicToRoman(400));
    }

    public function testConvertBigArabicNumberToRomanNumber()
    {
        $this->assertEquals('CDXLVIII', $this->romainConvertor->convertArabicToRoman(448));
        $this->assertEquals('MMVI', $this->romainConvertor->convertArabicToRoman(2006));
        $this->assertEquals('MMMCMXCIX', $this->romainConvertor->convertArabicToRoman(3999));
        $this->assertEquals('V̄CMXCIX', $this->romainConvertor->convertArabicToRoman(5999));
        $this->assertEquals('MX̄CMXCIX', $this->romainConvertor->convertArabicToRoman(9999));
        $this->assertEquals('X̄', $this->romainConvertor->convertArabicToRoman(10000));
        $this->assertEquals('X̄MV̄', $this->romainConvertor->convertArabicToRoman(14000));
        $this->assertEquals('X̄V̄', $this->romainConvertor->convertArabicToRoman(15000));
        $this->assertEquals('X̄X̄', $this->romainConvertor->convertArabicToRoman(20000));
        $this->assertEquals('X̄L̄', $this->romainConvertor->convertArabicToRoman(40000));
        $this->assertEquals('C̄M̄', $this->romainConvertor->convertArabicToRoman(900000));
        $this->assertEquals('M̄', $this->romainConvertor->convertArabicToRoman(1000000));
        $this->assertEquals('M̄C̄C̄', $this->romainConvertor->convertArabicToRoman(1200000));
        $this->assertEquals('C̄X̄L̄', $this->romainConvertor->convertArabicToRoman(140000));
        $this->assertEquals('M̄D̄', $this->romainConvertor->convertArabicToRoman(1500000));
        $this->assertEquals('M̄M̄M̄', $this->romainConvertor->convertArabicToRoman(3000000));
        $this->assertEquals('M̄M̄M̄M̄', $this->romainConvertor->convertArabicToRoman(4000000));
        $this->assertEquals('X̄MX̄VII', $this->romainConvertor->convertArabicToRoman(19007));
    }
}

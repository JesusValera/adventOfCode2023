<?php
declare(strict_types=1);

namespace KataTests;

use Kata\AdventCalendar3;
use PHPUnit\Framework\TestCase;

final class AdventCalendar3Test extends TestCase
{
    private const SAMPLE_STRING = <<<TXT
467..114..
...*......
..35..633.
......#...
617*......
.....+.58.
..592.....
......755.
...$.*....
.664.598..
TXT;

    public function testGetAboveNumberNextToSpecialChar(): void
    {
        $str = <<<TXT
...1.
...*.
.....
TXT;

        $advent = new AdventCalendar3($str);
        $result = $advent->solution1();

        self::assertEquals(1, $result);
    }

    public function testGetNumbersNextToSpecialChar(): void
    {
        $str = <<<TXT
..1.1
..1*1
..1.1
TXT;

        $advent = new AdventCalendar3($str);
        $result = $advent->solution1();

        self::assertEquals(6, $result);
    }

    public function testSpecialCharIsInBorder(): void
    {
        $str = <<<TXT
...1.
...1*
....1
TXT;

        $advent = new AdventCalendar3($str);
        $result = $advent->solution1();

        self::assertEquals(3, $result);
    }

    public function testNumberWithMultipleDigits(): void
    {
        $str = <<<TXT
..11.
...*.
...1.
TXT;

        $advent = new AdventCalendar3($str);
        $result = $advent->solution1();

        self::assertEquals(11 + 1, $result);
    }

    public function testSolution1Sample(): void
    {
        $advent = new AdventCalendar3(self::SAMPLE_STRING);
        $result = $advent->solution1();

        self::assertEquals(4361, $result);
    }

    public function testSolution1(): void
    {
        $str = file_get_contents(__DIR__ . '/fixtures/day3.txt');

        $advent = new AdventCalendar3($str);
        $result = $advent->solution1();

        self::assertEquals(539637, $result);
    }

    public function testSolution2Sample(): void
    {
        $advent = new AdventCalendar3(self::SAMPLE_STRING);
        $result = $advent->solution2();

        self::assertEquals(467835, $result);
    }

    public function testSolution2(): void
    {
        $str = file_get_contents(__DIR__ . '/fixtures/day3.txt');

        $advent = new AdventCalendar3($str);
        $result = $advent->solution2();

        self::assertEquals(82818007, $result);
    }
}

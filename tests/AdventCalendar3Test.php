<?php
declare(strict_types=1);

namespace KataTests;

use Kata\AdventCalendar3;
use PHPUnit\Framework\TestCase;

final class AdventCalendar3Test extends TestCase
{
    /**
     * Considerations:
     *
     * 1. Check limits of board ($table)
     * 2. Check the full number: go to left and right until surrounding dots
     * 3. If a number is surrounded by multiple special chars:
     * - Replace it by dots '.', we don't want to add it more than once
     */

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
..111
..1*1
..111
TXT;

        $advent = new AdventCalendar3($str);
        $result = $advent->solution1();

        self::assertEquals(8, $result);
    }

    public function testSpecialCharIsInBorder(): void
    {
        $str = <<<TXT
...1*
...11
.....
TXT;

        $advent = new AdventCalendar3($str);
        $result = $advent->solution1();

        self::assertEquals(3, $result);
    }
}

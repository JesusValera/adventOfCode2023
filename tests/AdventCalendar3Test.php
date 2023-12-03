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

    public function testGetPositionSpecialChar(): void
    {
        $str = <<<TXT
.....
...*.
*....
TXT;

        $advent = new AdventCalendar3($str);
        $result = $advent->solution1();

        self::assertEquals([[1, 3], [2, 0]], $result);
    }
}

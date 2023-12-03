<?php

declare(strict_types=1);

namespace KataTests;

use Kata\AdventCalendar1;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

final class AdventCalendar1Test extends TestCase
{
    private const SAMPLE_STRING_1 = <<<TXT
1abc2
pqr3stu8vwx
a1b2c3d4e5f
treb7uchet
TXT;

    private const SAMPLE_STRING_2 = <<<TXT
two1nine
eightwothree
abcone2threexyz
xtwone3four
4nineeightseven2
zoneight234
7pqrstsixteen
TXT;

    public function testSolution1Sample(): void
    {
        $calendar = new AdventCalendar1();
        $res = $calendar->solution1(self::SAMPLE_STRING_1);

        assertEquals(142, $res);
    }

    public function testSolution1(): void
    {
        $str = file_get_contents(__DIR__ . '/fixtures/day1.txt');

        $calendar = new AdventCalendar1();
        $res = $calendar->solution1($str);

        assertEquals(55123, $res);
    }

    public function testSolution2Sample(): void
    {
        $calendar = new AdventCalendar1();
        $res = $calendar->solution2(self::SAMPLE_STRING_2);

        assertEquals(281, $res);
    }

    public function testSolution2(): void
    {
        $str = file_get_contents(__DIR__ . '/fixtures/day1.txt');

        $calendar = new AdventCalendar1();
        $res = $calendar->solution2($str);

        assertEquals($res, 55260);
    }

    /**
     * @dataProvider numbersProvider
     */
    public function testTransformStringToText(string $n, string $expected): void
    {
        $calendar = new AdventCalendar1();
        $result = $calendar->transformText($n);

        self::assertEquals($expected, $result);
    }

    public static function numbersProvider(): iterable
    {
        yield ['two1nine', '219'];
        yield ['eightwothree', '823'];
        yield ['abcone2threexyz', '123'];
        yield ['xtwone3four', '2134'];
        yield ['4nineeightseven2', '49872'];
        yield ['zoneight234', '18234'];
        yield ['7pqrstsixteen', '76'];
        yield ['nineeightwo', '982'];
    }
}

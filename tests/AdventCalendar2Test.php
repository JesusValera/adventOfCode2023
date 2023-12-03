<?php

declare(strict_types=1);

namespace KataTests;

use Kata\AdventCalendar2;
use PHPUnit\Framework\TestCase;

final class AdventCalendar2Test extends TestCase
{
    private const SAMPLE_STRING = <<<TXT
Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green
Game 2: 1 blue, 2 green; 3 green, 4 blue, 1 red; 1 green, 1 blue
Game 3: 8 green, 6 blue, 20 red; 5 blue, 4 red, 13 green; 5 green, 1 red
Game 4: 1 green, 3 red, 6 blue; 3 green, 6 red; 3 green, 15 blue, 14 red
Game 5: 6 red, 1 blue, 3 green; 2 blue, 1 red, 2 green
TXT;

    public function testTransformStringToText(): void
    {
        $advent = new AdventCalendar2();
        $result = $advent->solution1(self::SAMPLE_STRING);

        self::assertEquals(15, $result);
    }

    public function testSolution1Sample(): void
    {
        $advent = new AdventCalendar2(12, 13, 14);
        $result = $advent->solution1(self::SAMPLE_STRING);

        self::assertEquals(8, $result);
    }

    public function testSolution1(): void
    {
        $str = file_get_contents(__DIR__ . '/fixtures/day2.txt');

        $advent = new AdventCalendar2(12, 13, 14);
        $result = $advent->solution1($str);

        self::assertEquals(2528, $result);
    }

    public function testSolution2Sample(): void
    {
        $advent = new AdventCalendar2();
        $result = $advent->solution2(self::SAMPLE_STRING);

        self::assertEquals(2286, $result);
    }

    public function testSolution2(): void
    {
        $str = file_get_contents(__DIR__ . '/fixtures/day2.txt');

        $advent = new AdventCalendar2();
        $result = $advent->solution2($str);

        self::assertEquals(67363, $result);
    }
}

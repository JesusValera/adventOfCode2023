<?php

declare(strict_types=1);

namespace Kata;

final readonly class AdventCalendar2
{
    public function __construct(
        private int $red = PHP_INT_MAX,
        private int $green = PHP_INT_MAX,
        private int $blue = PHP_INT_MAX,
    ) {
    }

    public function solution1(string $str): int
    {
        $lines = explode("\n", $str);

        $numbers = [];
        foreach ($lines as $line) {
            $addLine = true;

            [$game, $plays] = explode(':', $line);
            $number = preg_replace('/\D/', '', $game);

            $play = explode(';', $plays);
            foreach ($play as $game) {
                $ballBlue = 0;
                $ballRed = 0;
                $ballGreen = 0;
                $balls = explode(',', $game);
                foreach ($balls as $ball) {
                    [$numBalls, $color] = explode(' ', trim($ball));
                    switch ($color) {
                        case 'blue':
                            $ballBlue = (int)$numBalls;
                            break;
                        case 'red':
                            $ballRed = (int)$numBalls;
                            break;
                        case 'green':
                            $ballGreen = (int)$numBalls;
                            break;
                    }
                }
                if ($ballBlue > $this->blue || $ballRed > $this->red || $ballGreen > $this->green) {
                    $addLine = false;
                }
            }

            if ($addLine) {
                $numbers[] = $number;
            }
        }

        return array_reduce($numbers, static fn(int $carry, int $n) => $carry + $n, 0);
    }

    public function solution2(string $str): int
    {
        $lines = explode("\n", $str);

        $numbers = [];
        foreach ($lines as $line) {
            [, $plays] = explode(':', $line);

            $ballBlue = 0;
            $ballRed = 0;
            $ballGreen = 0;
            $play = explode(';', $plays);
            foreach ($play as $game) {
                $balls = explode(',', $game);
                foreach ($balls as $ball) {
                    [$numBalls, $color] = explode(' ', trim($ball));
                    switch ($color) {
                        case 'blue':
                            $ballBlue = $this->maxNumber((int)$numBalls, $ballBlue);
                            break;
                        case 'red':
                            $ballRed = $this->maxNumber((int)$numBalls, $ballRed);
                            break;
                        case 'green':
                            $ballGreen = $this->maxNumber((int)$numBalls, $ballGreen);
                            break;
                    }
                }
            }

            $numbers[] = $ballRed * $ballGreen * $ballBlue;
        }

        return array_reduce($numbers, static fn(int $carry, int $n) => $carry + $n, 0);
    }

    private function maxNumber(int $num1, int $num2): int
    {
        return max($num1, $num2);
    }
}

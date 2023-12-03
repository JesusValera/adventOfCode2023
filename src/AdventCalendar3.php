<?php

declare(strict_types=1);

namespace Kata;

final class AdventCalendar3
{
    private array $table = [];

    private const SYMBOLS = [
        '@', '$', '%', '#', '&', '*', '+', '=', '-', '~',
        '<', '>', '(', ')', '{', '}', '[', ']', '?', '!',
        ',', ';', ':', "'", '"', '^', '`', '/', '|', "\\",
    ];

    public function __construct(string $input)
    {
        $this->transformInputToTable($input);
    }

    private function transformInputToTable(string $input): void
    {
        $lines = explode(PHP_EOL, $input);

        foreach ($lines as $line) {
            $this->table[] = str_split($line);
        }
    }

    public function solution1(): int
    {
        $numbers = [];
        foreach ($this->table as $axisX => $row) {
            foreach ($row as $axisY => $char) {
                if (in_array($char, self::SYMBOLS, true)) {
                    for ($i = -1; $i <= 1; $i++) {
                        for ($j = -1; $j <= 1; $j++) {
                            // Current element is special char, cannot be a number
                            if ($i === 0 && $j === 0) {
                                continue;
                            }

                            $c = $this->table[$axisX + $i][$axisY + $j];
                            if (is_numeric($c)) {
                                $numbers[] = $c;
                            }
                        }
                    }
                }
            }
        }

        return array_reduce($numbers, static fn(int $carry, int $n) => $carry + $n, 0);
    }

    public function solution2(string $str): int
    {
        $numbers = [];

        return array_reduce($numbers, static fn(int $carry, int $n) => $carry + $n, 0);
    }
}

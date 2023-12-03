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
                    $numbers[] = $this->checkSurroundingChars($axisX, $axisY);
                }
            }
        }

        $flatNumbers = array_merge(...array_merge(...$numbers));
        return array_reduce($flatNumbers, static fn(int $carry, int $n) => $carry + $n, 0);
    }

    public function solution2(string $str): int
    {
        $numbers = [];

        return array_reduce($numbers, static fn(int $carry, int $n) => $carry + $n, 0);
    }

    private function checkSurroundingChars(int $axisX, int $axisY): array
    {
        $numbers = [];
        for ($i = -1; $i <= 1; $i++) {
            for ($j = -1; $j <= 1; $j++) {
                if ($this->currentPosition($i, $j)) {
                    continue;
                }

                $numbers[] = $this->getSurroundingNumbers($axisX, $i, $axisY, $j);
            }
        }

        return $numbers;
    }

    /**
     * Current element is always the special char, it cannot be a number
     */
    private function currentPosition(mixed $i, mixed $j): bool
    {
        return $i === 0 && $j === 0;
    }

    private function getSurroundingNumbers(int $axisX, int $i, int $axisY, int $j): array
    {
        $c = $this->table[$axisX + $i][$axisY + $j] ?? null;
        if (!is_numeric($c)) {
            return [];
        }

        $numbers = [];

        $posLeft = $this->getIndexLeftPositionsWithNumber($axisX + $i, $axisY + $j);
        $posRight = $this->getIndexRightPositionWithNumber($axisX + $i, $axisY + $j);

        $finalNumber = null;
        for ($z = -$posLeft; $z <= $posRight; $z++) {
            $finalNumber .= (string)$this->table[$axisX + $i][$axisY + $j + $z];
            // Reset number to do not count it twice
            $this->table[$axisX + $i][$axisY + $j + $z] = '.';
        }

        $numbers[] = $finalNumber;
        return $numbers;
    }

    private function getIndexLeftPositionsWithNumber(int $x, int $y): int
    {
        $posLeft = 0;
        do {
            $char = $this->table[$x][$y - 1 - $posLeft] ?? null;
            if (is_numeric($char)) {
                $posLeft++;
            }
        } while (is_numeric($char));

        return $posLeft;
    }

    private function getIndexRightPositionWithNumber(int $x, int $y): int
    {
        $posRight = 0;
        do {
            $char = $this->table[$x][$y + 1 + $posRight] ?? null;
            if (is_numeric($char)) {
                $posRight++;
            }
        } while (is_numeric($char));

        return $posRight;
    }
}

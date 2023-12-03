<?php

declare(strict_types=1);

namespace Kata;

final class AdventCalendar3
{
    private const GEAR_SYMBOL = '*';

    private const SYMBOLS = [
        '@', '$', '%', '#', '&', '*', '+', '=', '-', '~',
        '<', '>', '(', ')', '{', '}', '[', ']', '?', '!',
        ',', ';', ':', "'", '"', '^', '`', '/', '|', "\\",
    ];

    private array $table = [];

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
        return $this->calculateSolution(false);
    }

    public function solution2(): int
    {
        return $this->calculateSolution(true);
    }

    private function calculateSolution(bool $specialSymbol): int
    {
        $numbers = $this->getNumbers($specialSymbol);
        $flatNumbers = $this->flattenNumbers($numbers);

        return $this->sumNumbers($flatNumbers);
    }

    private function getNumbers(bool $specialSymbol): array
    {
        $numbers = [];
        foreach ($this->table as $axisX => $row) {
            foreach ($row as $axisY => $char) {
                if ($this->shouldCheckChar($char, $specialSymbol)) {
                    $numbers[] = $this->checkSurroundingChars($axisX, $axisY, $specialSymbol);
                }
            }
        }

        return $numbers;
    }

    private function shouldCheckChar(string $char, bool $specialSymbol): bool
    {
        return (!$specialSymbol && in_array($char, self::SYMBOLS, true)) // Solution 1
            || ($specialSymbol && $char === self::GEAR_SYMBOL); // Solution 2
    }

    private function checkSurroundingChars(int $axisX, int $axisY, bool $isSpecialSymbol): array
    {
        $surroundingCharNumbers = $this->getSurroundingCharNumbers($axisX, $axisY);

        return $this->applySpecialSymbolFilter($surroundingCharNumbers, $isSpecialSymbol);
    }

    private function getSurroundingCharNumbers(int $axisX, int $axisY): array
    {
        $numbers = [];
        for ($i = -1; $i <= 1; $i++) {
            for ($j = -1; $j <= 1; $j++) {
                if ($this->currentPosition($i, $j)) {
                    continue;
                }
                $numbers[] = $this->getSurroundingNumbers($axisX + $i, $axisY + $j);
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

    private function getSurroundingNumbers(int $axisX, int $axisY): array
    {
        $char = $this->table[$axisX][$axisY] ?? null;
        if (!is_numeric($char)) {
            return [];
        }

        $numbers = [];

        $posLeft = $this->getIndexLeftPositionsWithNumber($axisX, $axisY);
        $posRight = $this->getIndexRightPositionWithNumber($axisX, $axisY);

        $finalNumber = null;
        for ($z = -$posLeft; $z <= $posRight; $z++) {
            $finalNumber .= $this->table[$axisX][$axisY + $z];
            // Reset number to do not count it twice
            $this->table[$axisX][$axisY + $z] = '.';
        }

        $numbers[] = $finalNumber;
        return $numbers;
    }

    private function getIndexLeftPositionsWithNumber(int $x, int $y): int
    {
        return $this->getIndexPositionWithNumber($x, $y, -1);
    }

    private function getIndexRightPositionWithNumber(int $x, int $y): int
    {
        return $this->getIndexPositionWithNumber($x, $y, 1);
    }

    private function getIndexPositionWithNumber(int $x, int $y, int $direction): int
    {
        $pos = 0;
        do {
            $char = $this->table[$x][$y + $direction * ($pos + 1)] ?? null;
            if (is_numeric($char)) {
                $pos++;
            }
        } while (is_numeric($char));

        return $pos;
    }

    private function applySpecialSymbolFilter(array $numbers, bool $isSpecialSymbol): array
    {
        return !$isSpecialSymbol
            ? $numbers // Solution 1
            : $this->filterOnlyGears($numbers); // Solution 2
    }

    private function filterOnlyGears(array $numbers): array
    {
        $n = array_merge(...$numbers);

        // We only want arrays with 2 numbers
        if (count($n) !== 2) {
            return [[]];
        }

        return [[array_reduce($n, static fn($c, $v) => $c * $v, 1)]];
    }

    private function flattenNumbers(array $numbers): array
    {
        return array_merge(...array_merge(...$numbers));
    }

    private function sumNumbers(array $flatNumbers): int
    {
        return array_reduce($flatNumbers, static fn(int $carry, int $n) => $carry + $n, 0);
    }
}

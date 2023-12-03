<?php

declare(strict_types=1);

namespace Kata;

final readonly class AdventCalendar1
{
    private const NUMBERS = [
        1 => 'one',
        2 => 'two',
        3 => 'three',
        4 => 'four',
        5 => 'five',
        6 => 'six',
        7 => 'seven',
        8 => 'eight',
        9 => 'nine',
    ];

    public function solution1(string $str): int
    {
        $lines = explode("\n", $str);

        $numbers = [];
        foreach ($lines as $line) {
            $matches = preg_replace('/\D/', '', $line);
            $number = $matches[0] . $matches[-1];

            $numbers[] = $number;
        }

        return array_reduce($numbers, static fn(int $carry, int $n) => $carry + $n, 0);
    }

    public function solution2(string $str): int
    {
        $lines = explode("\n", $str);

        $numbers = [];
        foreach ($lines as $line) {
            $text = $this->transformText($line);

            $matches = preg_replace('/\D/', '', $text);
            $number = $matches[0] . $matches[-1];

            $numbers[] = $number;
        }

        return array_reduce($numbers, static fn(int $carry, int $n) => $carry + $n, 0);
    }

    public function transformText(string $line): string
    {
        $newLine = '';
        foreach (str_split($line) as $pos => $char) {
            if (is_numeric($char)) {
                $newLine .= $char;
                continue;
            }

            if (!in_array($char, ['o', 't', 'f', 's', 'e', 'n'])) {
                continue;
            }

            $newLine .= match ($char) {
                'o' => $this->charIsLetterO($line, $pos),
                't' => $this->charIsLetterT($line, $pos),
                'f' => $this->charIsLetterF($line, $pos),
                's' => $this->charIsLetterS($line, $pos),
                'e' => $this->charIsLetterE($line, $pos),
                'n' => $this->charIsLetterN($line, $pos),
                default => null,
            };
        }

        return $newLine;
    }

    private function charIsLetterO(string $line, int $pos): ?int
    {
        return substr($line, $pos, 3) === self::NUMBERS[1] ? 1 : null;
    }

    private function charIsLetterT(string $line, int $pos): ?int
    {
        if (substr($line, $pos, 3) === self::NUMBERS[2]) {
            return 2;
        }
        if (substr($line, $pos, 5) === self::NUMBERS[3]) {
            return 3;
        }

        return null;
    }

    private function charIsLetterF(string $line, int $pos): ?int
    {
        if (substr($line, $pos, 4) === self::NUMBERS[4]) {
            return 4;
        }
        if (substr($line, $pos, 4) === self::NUMBERS[5]) {
            return 5;
        }

        return null;
    }

    private function charIsLetterS(string $line, int $pos): ?int
    {
        if (substr($line, $pos, 3) === self::NUMBERS[6]) {
            return 6;
        }
        if (substr($line, $pos, 5) === self::NUMBERS[7]) {
            return 7;
        }

        return null;
    }

    private function charIsLetterE(string $line, int $pos): ?int
    {
        return substr($line, $pos, 5) === self::NUMBERS[8] ? 8 : null;
    }

    private function charIsLetterN(string $line, int $pos): ?int
    {
        return substr($line, $pos, 4) === self::NUMBERS[9] ? 9 : null;
    }
}

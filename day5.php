<?php

$day = 5;
$testInput = getInput($day, true);
$input = getInput($day);

class line
{
    private $startX;
    private $startY;
    private $endX;
    private $endY;

    public function __construct($line)
    {
        $parts = explode('->', $line);
        [$this->startX, $this->startY] = explode(',', trim($parts[0]));
        [$this->endX, $this->endY] = explode(',', trim($parts[1]));
    }

    public function plotOnGrid(&$grid, $straightOnly = false)
    {
        if($straightOnly && !$this->isStraight()) {
            return false;
        }

        $xs = range($this->startX, $this->endX);
        $ys = range($this->startY, $this->endY);
        for($i = 0; $i < max(count($xs), count($ys)); $i++) {
            $grid[$xs[min($i, count($xs)-1)]][$ys[min($i, count($ys)-1)]]++;
        }
    }

    private function isStraight(): bool
    {
        return $this->startX === $this->endX || $this->startY === $this->endY;
    }
}

function partOne(array $input, $straightOnly = true)
{
    $highest = 1000;
    $grid = array_fill(0, $highest, array_fill(0, $highest, 0));

    $lines = [];
    foreach ($input as $_input) {
        $lines[] = new line($_input);
    }

    foreach ($lines as $line) {
        $line->plotOnGrid($grid, $straightOnly);
    }

    $overlaps = 0;
    for($x = 0; $x < count($grid); $x++) {
        for($y = 0; $y < count($grid[0]); $y++) {
            if($grid[$x][$y] > 1) {
                $overlaps++;
            }
        }
    }

    return $overlaps;
}

$partOneTestOutput = partOne($testInput);

echo 'Part one test expected: 5' . '<br/>';
echo 'Part one test output: ' . $partOneTestOutput . '<br/>';
echo '<br/>';

$partOneOutput = partOne($input);

echo 'Part one output: ' . $partOneOutput . '<br/>';
echo '<br/>';

function partTwo(array $input)
{
    return partOne($input, false);
}

$partTwoTestOutput = partTwo($testInput);

echo 'Part two test expected: 12' . '<br/>';
echo 'Part two test output: ' . $partTwoTestOutput . '<br/>';
echo '<br/>';

$partTwoOutput = partTwo($input);

echo 'Part two output: ' . $partTwoOutput . '<br/>';
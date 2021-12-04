<?php

$day = 2;
$testInput = getInput($day, true);
$input = getInput($day);

function partOne(array $input)
{
    $h = 0;
    $v = 0;
    foreach ($input as $command) {
        $parts = explode(' ', $command);
        switch($parts[0]) {
            case 'forward':
                $h += $parts[1];
                break;
            case 'down':
                $v += $parts[1];
                break;
            case 'up':
                $v -= $parts[1];
                break;
        }
    }

    return $h * $v;
}

$partOneTestOutput = partOne($testInput);

echo 'Part one test expected: 150' . '<br/>';
echo 'Part one test output: ' . $partOneTestOutput . '<br/>';
echo '<br/>';

$partOneOutput = partOne($input);

echo 'Part one output: ' . $partOneOutput . '<br/>';
echo '<br/>';

function partTwo(array $input)
{
    $h = 0;
    $v = 0;
    $a = 0;
    foreach ($input as $command) {
        $parts = explode(' ', $command);
        switch($parts[0]) {
            case 'forward':
                $h += $parts[1];
                $v += ($a * $parts[1]);
                break;
            case 'down':
                $a += $parts[1];
                break;
            case 'up':
                $a -= $parts[1];
                break;
        }
    }

    return $h * $v;
}

$partTwoTestOutput = partTwo($testInput);

echo 'Part two test expected: 900' . '<br/>';
echo 'Part two test output: ' . $partTwoTestOutput . '<br/>';
echo '<br/>';

$partTwoOutput = partTwo($input);

echo 'Part two output: ' . $partTwoOutput . '<br/>';
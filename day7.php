<?php

$day = 7;
$testInput = getInput($day, true);
$input = getInput($day);

function partOne(array $input)
{
    $crabs = explode(',', $input[0]);
    $highest = max($crabs);
    $least = PHP_INT_MAX;
    $position = -1;
    for($i = 0; $i < $highest; $i++) {
        $fuel = 0;
        foreach ($crabs as $crab) {
            $fuel += abs($i - $crab);
        }
        if($fuel < $least) {
            $least = $fuel;
            $position = $i;
        }
    }

    return [$least, $position];
}

[$partOneTestOutput, $pos1Test] = partOne($testInput);

echo 'Part one test expected: 37' . '<br/>';
echo 'Part one test output: ' . $partOneTestOutput . ' - ' . $pos1Test . '<br/>';
echo '<br/>';

[$partOneOutput, $pos1] = partOne($input);

echo 'Part one output: ' . $partOneOutput . ' - ' . $pos1 . '<br/>';
echo '<br/>';

function partTwo(array $input)
{
    $crabs = explode(',', $input[0]);
    $highest = max($crabs);
    $least = PHP_INT_MAX;
    $position = -1;
    for($i = 0; $i < $highest; $i++) {
        $fuel = 0;
        foreach ($crabs as $crab) {
            $h = abs($i - $crab);
            $fuel += ($h+1)*($h/2);
        }
        if($fuel < $least) {
            $least = $fuel;
            $position = $i;
        }
    }

    return [$least, $position];
}

[$partTwoTestOutput, $pos2Test] = partTwo($testInput);

echo 'Part two test expected: 168' . '<br/>';
echo 'Part two test output: ' . $partTwoTestOutput . ' - ' . $pos2Test . '<br/>';
echo '<br/>';

[$partTwoOutput, $pos2] = partTwo($input);

echo 'Part two output: ' . $partTwoOutput . ' - ' . $pos2 . '<br/>';



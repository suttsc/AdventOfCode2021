<?php

$day = 6;
$testInput = getInput($day, true);
$input = getInput($day);

function partOne(array $input, $days = 80)
{
    $fishes = explode(',', $input[0]);
    $fishes = array_map(fn($f) => (int)$f, $fishes);

    $ages = array_pad([], 9, 0);
    foreach ($fishes as $fish) {
        $ages[$fish]++;
    }
    for($day = 1; $day <= $days; $day++) {
        $newFish = array_shift($ages);
        $ages[6] += $newFish;
        $ages[8] = $newFish;
    }

    return array_sum($ages);
}

$partOneTestOutput = partOne($testInput);

echo 'Part one test expected: 5934' . '<br/>';
echo 'Part one test output: ' . $partOneTestOutput . '<br/>';
echo '<br/>';

$partOneOutput = partOne($input);

echo 'Part one output: ' . $partOneOutput . '<br/>';
echo '<br/>';

function partTwo(array $input)
{
    return partOne($input, 256);
}

$partTwoTestOutput = partTwo($testInput);

echo 'Part two test expected: 26984457539' . '<br/>';
echo 'Part two test output: ' . $partTwoTestOutput . '<br/>';
echo '<br/>';

$partTwoOutput = partTwo($input);

echo 'Part two output: ' . $partTwoOutput . '<br/>';
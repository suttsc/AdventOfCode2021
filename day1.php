<?php

$day = 1;
$testInput = getInput($day, true);
$input = getInput($day);

function partOne(array $input)
{
    $previous = array_shift($input);
    $count = 0;
    foreach ($input as $next) {
        if($next > $previous) $count++;
        $previous = $next;
    }

    return $count;
}

$partOneTestOutput = partOne($testInput);

echo 'Part one test expected: 7' . '<br/>';
echo 'Part one test output: ' . $partOneTestOutput . '<br/>';
echo '<br/>';

$partOneOutput = partOne($input);

echo 'Part one output: ' . $partOneOutput . '<br/>';
echo '<br/>';

function partTwo(array $input)
{
    $previous = array_sum(array_slice($input, 0, 3));
    $count = 0;
    for ($i = 1; $i < count($input) - 2; $i++) {
        $next = array_sum(array_slice($input, $i, 3));
        if($next > $previous) $count++;
        $previous = $next;
    }

    return $count;
}

$partTwoTestOutput = partTwo($testInput);

echo 'Part two test expected: 5' . '<br/>';
echo 'Part two test output: ' . $partTwoTestOutput . '<br/>';
echo '<br/>';

$partTwoOutput = partTwo($input);

echo 'Part two output: ' . $partTwoOutput . '<br/>';
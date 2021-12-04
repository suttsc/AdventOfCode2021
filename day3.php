<?php

$day = 3;
$testInput = getInput($day, true);
$input = getInput($day);

function partOne($input)
{
    $total = count($input);
    $len = strlen($input[0]);
    $ones = array_fill(0, $len, 0);
    foreach ($input as $bits) {
        for ($i = 0; $i < $len; $i++) {
            $ones[$i] += (int)$bits[$i] === 1;
        }
    }

    $gamma = $epsilon = [];
    foreach ($ones as $one) {
        $gamma[] = $one > $total/2 ? '1' : '0';
        $epsilon[] = $one < $total/2 ? '1' : '0';
    }
    $gamma = bindec((int)implode('', $gamma));
    $epsilon = bindec((int)implode('', $epsilon));

    return $gamma * $epsilon;
}

$partOneTestOutput = partOne($testInput);

echo 'Part one test expected: 198' . '<br/>';
echo 'Part one test output: ' . $partOneTestOutput . '<br/>';
echo '<br/>';

$partOneOutput = partOne($input);

echo 'Part one output: ' . $partOneOutput . '<br/>';
echo '<br/>';

function partTwo($input)
{
    $len = strlen($input[0]);

    $oxygenInput = $input;
    for($i = 0; $i < $len; $i++) {
        $ones = $zeroes = [];
        foreach ($oxygenInput as $item) {
            if((int)$item[$i] === 1) {
                $ones[] = $item;
            } else {
                $zeroes[] = $item;
            }
        }
        $oxygenInput = count($ones) >= count($zeroes) ? $ones : $zeroes;
        if(count($oxygenInput) === 1) break;
    }
    $oxygen = bindec($oxygenInput[0]);

    $co2Input = $input;
    for($i = 0; $i < $len; $i++) {
        $ones = $zeroes = [];
        foreach ($co2Input as $item) {
            if((int)$item[$i] === 1) {
                $ones[] = $item;
            } else {
                $zeroes[] = $item;
            }
        }
        $co2Input = count($ones) < count($zeroes) ? $ones : $zeroes;
        if(count($co2Input) === 1) break;
    }
    $co2 = bindec($co2Input[0]);

    return $oxygen * $co2;
}

$partTwoTestOutput = partTwo($testInput);

echo 'Part two test expected: 230' . '<br/>';
echo 'Part two test output: ' . $partTwoTestOutput . '<br/>';
echo '<br/>';

$partTwoOutput = partTwo($input);

echo 'Part two output: ' . $partTwoOutput . '<br/>';
<?php

$day = 4;
$testInput = getInput($day, true);
$input = getInput($day);

class board
{
    public int $index;
    private array $rows = [];
    private array $marked;
    private bool $completed = false;

     /**
     * @param $input
     * @return array<int, board>
     */
    public static function getBoards($input): array
    {
        $boards = [];
        $rows = [];
        foreach ($input as $row) {
            if(!empty($row)) {
                $rows[] = $row;
            }
        }
        $chunks = array_chunk($rows, 5);
        $cnt = 1;
        foreach ($chunks as $chunk) {
            $board = new board($chunk);
            $board->index = $cnt++;
            $boards[] = $board;
        }

        return $boards;
    }

    public function __construct($rows)
    {
        foreach ($rows as $row) {
            $this->rows[] = explode(' ', str_replace('  ', ' ', trim($row)));
        }
        foreach ($this->rows as &$row) {
            foreach ($row as &$num) {
                $num = (int)$num;
            }
        }
        $this->marked = array_fill(0, count($this->rows), array_fill(0, count($this->rows[0]), 0));
    }

    public function markNumber(int $number): bool
    {
        for ($x = 0; $x < count($this->rows); $x++) {
            for ($y = 0; $y < count($this->rows[0]); $y++) {
                if($this->rows[$x][$y] === $number) {
                    $this->marked[$x][$y] = 1;
                    return true;
                }
            }
        }

        return false;
    }

    public function markAsCompleted(): void
    {
        $this->completed = true;
    }

    public function completed(): bool
    {
        return $this->completed;
    }

    public function checkForLine(): bool
    {
        if($this->checkForRow()) {
            $this->markAsCompleted();
            return true;
        }
        if($this->checkForColumn()) {
            $this->markAsCompleted();
            return true;
        }

        return false;
    }

    private function checkForRow(): bool
    {
        foreach ($this->marked as $row) {
            if(array_sum($row) === count($row)) {
                return true;
            }
        }

        return false;
    }

    private function checkForColumn(): bool
    {
        for ($y = 0; $y < count($this->marked[0]); $y++) {
            $cnt = 0;
            for ($x = 0; $x < count($this->marked); $x++) {
                $cnt += $this->marked[$x][$y];
            }
            if($cnt === count($this->marked[0])) {
                return true;
            }
        }

        return false;
    }

    public function totalUnmarked(): int
    {
        $total = 0;

        for ($x = 0; $x < count($this->marked); $x++) {
            for ($y = 0; $y < count($this->marked[0]); $y++) {
                if($this->marked[$x][$y] === 0) {
                    $total += $this->rows[$x][$y];
                }
            }
        }

        return $total;
    }
}

function partOne(array $input)
{
    $numbers = explode(',', array_shift($input));
    $boards = board::getBoards($input);

    foreach ($numbers as $number) {
        foreach ($boards as $board) {
            if($board->markNumber((int)$number)) {
                if($board->checkForLine()) {
                    return $board->totalUnmarked() * (int)$number;
                }
            }
        }
    }
}

$partOneTestOutput = partOne($testInput);

echo 'Part one test expected: 4512' . '<br/>';
echo 'Part one test output: ' . $partOneTestOutput . '<br/>';
echo '<br/>';

$partOneOutput = partOne($input);

echo 'Part one output: ' . $partOneOutput . '<br/>';
echo '<br/>';

function partTwo(array $input)
{
    $numbers = explode(',', array_shift($input));
    $boards = board::getBoards($input);
    $totalBoards = count($boards);
    $totalCompleted = 0;

    foreach ($numbers as $number) {
        foreach ($boards as $board) {
            if(!$board->completed() && $board->markNumber((int)$number) && $board->checkForLine()) {
                if($board->completed()) {
                    $totalCompleted++;
                    if ($totalCompleted === $totalBoards) {
                        return $board->totalUnmarked() * (int)$number;
                    }
                }
            }
        }
    }
}

$partTwoTestOutput = partTwo($testInput);

echo 'Part two test expected: 1924' . '<br/>';
echo 'Part two test output: ' . $partTwoTestOutput . '<br/>';
echo '<br/>';

$partTwoOutput = partTwo($input);

echo 'Part two output: ' . $partTwoOutput . '<br/>';
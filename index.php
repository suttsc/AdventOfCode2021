<?php

function getInput(int $day, bool $test = false): array
{
    $contents = file_get_contents('./inputs/day' . $day . ($test ? '_test' : '') . '.txt');

    if($contents) {
        return explode("\r\n", $contents);
    }

    return [];
}

$path = ltrim($_SERVER['REQUEST_URI'], '/');

if(file_exists('./' . $path . '.php')) {
    require_once $path . '.php';
}


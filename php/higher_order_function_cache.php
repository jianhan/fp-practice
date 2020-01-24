<?php

/*
..######.....###.....######..##.....##.########
.##....##...##.##...##....##.##.....##.##......
.##........##...##..##.......##.....##.##......
.##.......##.....##.##.......#########.######..
.##.......#########.##.......##.....##.##......
.##....##.##.....##.##....##.##.....##.##......
..######..##.....##..######..##.....##.########
 */

$add = function (int $x, int $y): int {
    sleep(1);
    return $x + $y;
};

$memorize = function (callable $f) {
    return function (...$args) use ($f) {
        static $cached = [];
        $argsKey = json_encode($args);
        if (array_key_exists($argsKey, $cached)) {
            var_dump("cache exists with key " . $argsKey . " and value " . $cached[$argsKey]);
            return $cached[$argsKey];
        }

        $cached[$argsKey] = $result = $f(...$args);
        return $result;
    };
};

$memAdd = $memorize($add);

//var_dump($add(1,2));
//var_dump($add(1,2));
//var_dump($add(1,2));

var_dump($memAdd(1, 2));
var_dump($memAdd(1, 2));
var_dump($memAdd(5, 6));
var_dump($memAdd(5, 6));

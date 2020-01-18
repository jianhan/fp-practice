<?php

$add2Numbers = function (int $x, int $y): int {
    return $x + $y;
};

// Manual version
$add2NumbersCurry = function (int $x): callable {
    return function (int $y) use ($x): int {
        return $x + $y;
    };
};
$add10To = $add2NumbersCurry(10);
var_dump($add10To(1)); // int (11)
var_dump($add10To(10)); // int (20)

// Do it by using FP library/helper functions, this is what you will see in production
$add100To = curry_left($add2Numbers, 100);
var_dump($add100To(100));

/*
.##.....##.########.##.......########..########.########.....########.##.....##.##....##..######..########.####..#######..##....##..######.
.##.....##.##.......##.......##.....##.##.......##.....##....##.......##.....##.###...##.##....##....##.....##..##.....##.###...##.##....##
.##.....##.##.......##.......##.....##.##.......##.....##....##.......##.....##.####..##.##..........##.....##..##.....##.####..##.##......
.#########.######...##.......########..######...########.....######...##.....##.##.##.##.##..........##.....##..##.....##.##.##.##..######.
.##.....##.##.......##.......##........##.......##...##......##.......##.....##.##..####.##..........##.....##..##.....##.##..####.......##
.##.....##.##.......##.......##........##.......##....##.....##.......##.....##.##...###.##....##....##.....##..##.....##.##...###.##....##
.##.....##.########.########.##........########.##.....##....##........#######..##....##..######.....##....####..#######..##....##..######.
 */

function curry_left($callable)
{
    $outerArguments = func_get_args();
    array_shift($outerArguments);

    return function () use ($callable, $outerArguments) {
        return call_user_func_array($callable, array_merge($outerArguments, func_get_args()));
    };
}

function curry_right($callable)
{
    $outerArguments = func_get_args();
    array_shift($outerArguments);

    return function () use ($callable, $outerArguments) {
        return call_user_func_array($callable, array_merge(func_get_args(), $outerArguments));
    };
}

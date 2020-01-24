<?php
require_once "./curry_helpers.php";

$add3numbers = function (int $x, int $y, int $z): int {
    return $x + $y + $z;
};

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
$add100To = curry($add2Numbers, 100);
//var_dump($add100To(100));

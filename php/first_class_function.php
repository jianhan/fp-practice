<?php

// Example 1. assign function to variable.
$add = function (int $x, int $y): int {
    return $x + $y;
};
var_dump($add(1, 2)); // int(3)

// Example 2. pass function as arg
$divide = function (int $x, int $y): int {
    if ($y === 0) {
        throw new Exception("Can not divided by 0: " . $x . "/" . $y);
    }

    return $x / $y;
};
$tryCatch = function (callable $x, ...$args) {
    // this function can be used for any function that throw exception
    try {
        return $x(...$args);
    } catch (Exception $e) {
        // you can log it too
        echo "Exception occur " . $e->getMessage();
    }
};
var_dump($tryCatch($divide, 20, 10)); // int(2)
var_dump($tryCatch($divide, 20, 0)); // Exception occur Can not divided by 0: 20/0NULL

<?php

// Example 1, inpure, hard coded new DateTime
function calculateAge(DateTime $birthday): string
{
    return date_diff(new DateTime(), $birthday)->format("%y");
}

$birthday = new DateTime("1990-01-01");
//var_dump(calculateAge($birthday)); // string 30

// Example 1, Functional way, notice this function is much more generic, thus better reusbility
$dateDiff = function (DateTime $firstDate, DateTime $secondDate): callable {
    return function (string $format) use ($firstDate, $secondDate): string {
        return date_diff($firstDate, $secondDate)->format($format);
    };
};

$diff = $dateDiff($birthday, new DateTime());

// better abstraction, it can be use for any kind of date diff, not just for birthday
 var_dump($diff("%y")); // string 30
 var_dump($diff("%y Year %m Month %d Day %h Hours %i Minute %s Seconds")); // "30 Year 0 Month 17 Day 12 Hours 34 Minute 18 Seconds"

<?php

class Location {
    public $country;
    public $state;
    public $suburb;
    public function __construct(string $country, string $state, string $suburb) {
        $this->country = $country;
        $this->state = $state;
        $this->suburb = $suburb;
    }
}

class Car {
    public $model;
    public $type;
    public $make;
    public $year;
    public $kilometers;
    public $price;
    public $cylinder;
    public $location;
}

class Student {
    public $name;
    public $age;
    public $minPrice;
    public $maxPrice;
    public $maxKilometers;
    public $preferredMakes;
    public $preferredTypes;
    public $minYear;
    public $location;

    public $recommendedCars;
}

$allen = new Student();
$allen->name = "Allen";
$allen->age = 18;
$allen->minPrice = 5000;
$allen->maxPrice = 10000;
$allen->maxKilometers = 100000;
$allen->preferredMakes = ["Toyota", "BMW", "VW"];
$allen->minYear = 2008;
$allen->location = new Location("Australia", "QLD", "Brisbane CBD");

$bob = new Student();
$bob->name = "Bob";
$bob->age = 22;
$bob->preferredMakes = ["Audi", "Kia", "Mazda"];

$carl = new Student();
$carl->name = "Carl";
$carl->age = 16;
$carl->minYear = 2001;



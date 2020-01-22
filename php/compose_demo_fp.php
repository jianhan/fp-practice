<?php

require_once "./vendor/autoload.php";
require_once "./curry_helpers.php";
require_once "./compose_demo_classes.php";

use function Lambdish\Phunctional\compose;
use function Lambdish\Phunctional\flat_map;
use function Lambdish\Phunctional\map;
use function Lambdish\Phunctional\reduce;

$seedingData = [
    ['   Charlie', 'Labrador Retriever', ["Kiss", "Talk", "Shake Hands", "Fetch", "Roll Over", "Play Dead", "Spin", "Sit", "Hug"]],
    ['Max   ', ' Golden Retriever	', ["Kiss", "Talk", "Shake Hands", "Fetch", "Roll Over", "Play Dead"]],
    ['BUDDY  ', ' Beagle', ["Kiss", "Talk", "Shake Hands", "Fetch", "Roll Over"]],
    ['Oscar', ' Dachshund', ["Shake Hands", "Fetch", "Roll Over", "Play Dead"]],
    ['MILO', '    DACHSHUND', ["Roll Over", "Play Dead", "Spin", "Sit", "Hug"]],
    ['Archie', 'Boxer', ["Kiss", "Talk", "Shake Hands", "Fetch", "Roll Over", "Play Dead", "Spin", "Sit", "Hug"]],
    ['  ollie', 'Poodle', ["Shake Hands", "Fetch", "Roll Over", "Play Dead", "Spin", "Sit", "Hug"]],
    ['Toby   ', 'Poodle', ["Sit"]],
    ['JACK', 'BORDER TERRIER', ["Fetch", "Roll Over"]],
    ['Teddy', 'Yorkshire Terrier', ["Shake Hands", "Fetch", "Shake Hands", "Fetch", "Roll Over", "Play Dead"]],
    ['Bella  ', 'German Shepherd', ["Play Dead", "Roll Over"]],
];

$transformArr = function (array $indexes, callable $fn, array $arr): array{
    foreach ($indexes as $index) {
        $arr[$index] = $fn($arr[$index]);
    }

    return $arr;
};

$trim = function (string $str) {
    return trim($str);
};

$ucwords = function (string $str) {
    return ucwords(strtolower($str));
};

$trimNamesAndBreedes = curry($transformArr, [0, 1], $trim);

$unifyNamesAndBreeds = curry($transformArr, [0, 1], $ucwords);

$rowToObj = function (array $row): Dog {
    $dog = new Dog();
    $dog->name = $row[0];
    $dog->breed = $row[1];
    $dog->tricks = $row[2];
    return $dog;
};

/**
 * COMPOSITION HERE
 */
$cleanDogs = map(
    compose($rowToObj, $unifyNamesAndBreeds, $trimNamesAndBreedes),
    $seedingData
);

// var_dump($cleanDogs);

$getTrick = function (Dog $d): array{
    return $d->tricks;
};

$reduceFunc = function (array $acc, Dog $d): array{
    $acc[] = $d->breed;
    return $acc;
};

$allTricks = array_unique(flat_map($getTrick, $cleanDogs));
$allBreeds = array_unique(reduce($reduceFunc, $cleanDogs, []));

$findDogsByBreedOriginal = function (array $dogs, string $breed): array{
    $foundDogs = [];
    foreach ($dogs as $dog) {

        if ($dog->breed === $breed) {
            $foundDogs[] = $dog;
        }
    }
    return $foundDogs;
};

$findDogsByTricksOriginal = function (array $dogs, array $tricks): array{
    $foundDogs = [];
    foreach ($dogs as $dog) {
        if (count(array_intersect($tricks, $dog->tricks)) === count($tricks)) {
            $foundDogs[] = $dog;
        }
    }
    return $foundDogs;
};

// var_dump($allTricks);
// var_dump($allBreeds);
// var_dump($findDogsByBreedOriginal($cleanDogs, "Beagle"));
// var_dump($findDogsByTricksOriginal($cleanDogs, ["Kiss", "Talk", "Shake Hands", "Fetch"]));

$isBreedEqual = function (string $breed, Dog $dog): bool {
    return $dog->breed === $breed;
};

$hasAllTricks = function (array $tricks, Dog $dog): bool {
    return count(array_intersect($tricks, $dog->tricks)) === count($tricks);
};

$findDogsBy = function (array $dogs, callable $fn): array{
    $foundDogs = [];
    foreach ($dogs as $dog) {
        if ($fn($dog)) {
            $foundDogs[] = $dog;
        }
    }
    return $foundDogs;
};

// var_dump($findDogsBy($cleanDogs, curry($isBreedEqual, "Poodle")));
// var_dump($findDogsBy($cleanDogs, curry($hasAllTricks, ["Kiss", "Talk", "Shake Hands", "Fetch", "Roll Over", "Play Dead", "Spin", "Sit", "Hug"])));

$findDogByBreedForPerson = function (array $dogs, Person $person) use ($findDogsBy, $isBreedEqual) {
    $person->recommendedDogs = $findDogsBy($dogs, curry($isBreedEqual, $person->preferredBreed));
    return $person;
};

$findDogByTricksForPerson = function (array $dogs, Person $person) use ($findDogsBy, $hasAllTricks) {
    $person->recommendedDogs = $findDogsBy($dogs, curry($hasAllTricks, $person->mustHaveTricks));
    return $person;
};

$adam = new Person();
$adam->name = "Adam";
$adam->preferredBreed = "Boxer";
$adam->mustHaveTricks = ["Sit", "Shake Hands"];

$bob = new Person();
$bob->name = "Bob";
$bob->preferredBreed = "Dachshund";
$bob->mustHaveTricks = ["Play Dead"];

$chris = new Person();
$chris->name = "Chris";
$chris->preferredBreed = "Labrador Retriever";
$chris->mustHaveTricks = ["Kiss", "Talk", "Shake Hands", "Fetch", "Roll Over", "Play Dead", "Spin", "Sit", "Hug"];

/**
 * COMPOSITION HERE
 */
$recommendDogs = map(
    compose(
        curry($findDogByBreedForPerson, $cleanDogs),
        curry($findDogByTricksForPerson, $cleanDogs)
    ),
    [$adam, $bob, $chris]
);

// var_dump($recommendDogs);

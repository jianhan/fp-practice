<?php

require_once "./compose_demo_classes.php";

// TESTING TIME
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

$shelter = new DogsShelter($seedingData);

// $shelter functions basic
//  var_dump($shelter->getDogs());
// var_dump($shelter->allTricks());
// var_dump($shelter->allBreeds());

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
// $shelter function recommendDogs
var_dump($shelter->recommendDogs([$adam, $bob, $chris]));

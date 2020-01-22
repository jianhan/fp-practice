<?php

class Dog
{
    public $name;
    public $breed;
    public $tricks;
}

class Person
{
    public $name;
    public $preferredBreed;
    public $mustHaveTricks;
    public $recommendedDogs;
}

class DogsShelter
{
    private $dogs;

    public function __construct(array $dogsData = [])
    {
        $this->dogs = [];
        $this->parseDogArray($dogsData);
    }

    private function parseDogArray(array $dogsData)
    {
        foreach ($dogsData as $dogData) {
            $dog = new Dog();
            $dog->name = ucwords(strtolower(trim($dogData[0])));
            $dog->breed = ucwords(strtolower(trim($dogData[1])));
            $dog->tricks = $dogData[2];
            $this->dogs[] = $dog;
        }
    }

    public function allTricks(): array
    {
        $tricks = [];
        foreach ($this->dogs as $dog) {
            foreach ($dog->tricks as $trick) {
                $tricks[] = $trick;
            }
        }

        return array_unique($tricks);
    }

    public function allBreeds(): array
    {
        // get all breeds first
        $breeds = [];
        foreach ($this->dogs as $dog) {
            $breeds[] = $dog->breed;
        }
        $breeds = array_unique($breeds);

        // search through dogs to find how many of dogs for each breed
        $breedWithDogs = [];
        foreach ($breeds as $breed) {
            foreach ($this->dogs as $dog) {
                if ($dog->breed === $breed) {
                    $breedWithDogs[$breed][] = $dog;
                }
            }
        }
        return $breedWithDogs;
    }

    private static function findDogsByBreed(array $dogs, string $breed): array
    {
        $foundDogs = [];
        foreach ($dogs as $dog) {

            if ($dog->breed === $breed) {
                $foundDogs[] = $dog;
            }
        }
        return $foundDogs;
    }

    private static function findDogsByTricks(array $dogs, array $tricks): array
    {
        $foundDogs = [];
        foreach ($dogs as $dog) {
            if (count(array_intersect($tricks, $dog->tricks)) === count($tricks)) {
                $foundDogs[] = $dog;
            }
        }
        return $foundDogs;
    }

    public function recommendDogs(array $persons = []): array
    {
        foreach ($persons as $person) {
            // find by breed
            $dogs = self::findDogsByBreed($this->dogs, $person->preferredBreed);

            // find dogs by tricks
            $dogs = self::findDogsByTricks($dogs, $person->mustHaveTricks);

            $person->recommendedDogs = $dogs;
        }

        return $persons;
    }

    public function getDogs(): array
    {
        return $this->dogs;
    }
}

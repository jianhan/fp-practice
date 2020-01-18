<?php

class Student
{
    private $name;
    private $gpa;

    public function __construct(string $name, float $gpa)
    {
        $this->name = $name;
        $this->gpa = $gpa;
    }

    public function setGpa(float $gpa)
    {
        $this->gpa = $gpa;
    }

    public function __toString(): string
    {
        return sprintf("Student %s, GPA: %f", $this->name, $this->gpa);
    }
}

// Example mutable
$bob = new Student("Bob", 0);
function endOfSem(int $sem, Student $student, float $gpa)
{
    $student->setGpa($gpa);
    var_dump("end of semester " . $sem . " - " . $student);
}
endOfSem(1, $bob, 7);
endOfSem(2, $bob, 5);
endOfSem(3, $bob, 2);
endOfSem(4, $bob, 5);
endOfSem(6, $bob, 6);
var_dump("original gpa " . $bob);

// Immutable
function endOfSemImm(int $sem, Student $student, float $gpa)
{
    $clonedStudent = clone $student;
    $clonedStudent->setGpa($gpa);
    return $clonedStudent;
}
$jim = new Student("Jim", 0);
$jimSem1 = endOfSemImm(1, $jim, 7);
$jimSem2 = endOfSemImm(2, $jim, 5);
$jimSem3 = endOfSemImm(3, $jim, 2);
$jimSem4 = endOfSemImm(4, $jim, 5);
$jimSem5 = endOfSemImm(6, $jim, 6);

var_dump($jimSem1->__toString(), $jimSem2->__toString(), $jimSem3->__toString(), $jimSem4->__toString(), $jimSem5->__toString(), "original gpa " . $jim);

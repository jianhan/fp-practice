<?php

/*
.##.......####.##.....##.####.########....########..##.....##.##....##.##....##.########.########.
.##........##..###...###..##.....##.......##.....##.##.....##.###...##.###...##.##.......##.....##
.##........##..####.####..##.....##.......##.....##.##.....##.####..##.####..##.##.......##.....##
.##........##..##.###.##..##.....##.......########..##.....##.##.##.##.##.##.##.######...########.
.##........##..##.....##..##.....##.......##...##...##.....##.##..####.##..####.##.......##...##..
.##........##..##.....##..##.....##.......##....##..##.....##.##...###.##...###.##.......##....##.
.########.####.##.....##.####....##.......##.....##..#######..##....##.##....##.########.##.....##
 */
// Example : OO implementation
interface Runnerable
{
    public function run();
}

class HelloWorldRunner implements Runnerable
{
    public function run()
    {
        print("Hello World \n");
    }
}

class Processor
{
    private $counter;

    private $limit;

    private $runner;

    public function __construct(Runnerable $runner, $limit = 1)
    {
        $this->runner = $runner;
        $this->counter = 0;
        $this->limit = $limit;
    }

    public function run(): void
    {
        if ($this->counter < $this->limit) {
            $this->runner->run();
            $this->counter++;
            return;
        }

        echo 'Unable to run, limit reached, counter: ' . $this->counter . ' , limit ' . $this->limit . "\n";
    }

}

$p = new Processor(new HelloWorldRunner(), 5);

//$p->run();
//$p->run();
//$p->run();
//$p->run();
//$p->run();
// next one will fail
//$p->run();

// Example FP implementation
$processorFP = static function (Runnerable $runner, int $limit) {
    return static function () use ($limit, $runner) {
        static $counter = 0;

        // early return bail
        if ($counter >= $limit) {
            echo 'Unable to run, limit reached, counter: ' . $counter . ' , limit ' . $limit . "\n";
            return;
        }

        // logic goes here
        $runner->run();
        $counter++;
        var_dump("runner ran, counter is " . $counter . ", limit is " . $limit);

    };
};

$process5 = $processorFP(new HelloWorldRunner(), 5);
$process5();
$process5();
$process5();
$process5();
$process5();
// this one will fail
$process5();

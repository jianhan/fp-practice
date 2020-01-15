<?php

interface Runnerable {
    public function run();
}

class HelloWorldRunner implements Runnerable {
    public function run() {
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

    public function run() {
        if ($this->counter < $this->limit) {
            $this->runner->run();
            $this->counter++;
            return;
        }

        echo 'Unable to run, limit reached, counter: '. $this->counter.' , limit '. $this->limit. "\n";
    }

    public function reset()
    {
        $this->counter = 0;
        $this->limit = 1;
    }
}

$p = new Processor(new HelloWorldRunner(), 5);

$p->run();
$p->run();
$p->run();
$p->run();
$p->run();
$p->reset();
$p->run();


$processor = function () {

};

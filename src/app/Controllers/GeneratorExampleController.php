<?php

namespace App\Controllers;

class GeneratorExampleController
{
    public function __construct()
    {
    }

    public function index()
    {
        $numbers = $this->lazyRange(1, 3000000);
//        $numbers->next();
 
//        echo '<pre>';
//        print_r($numbers->current());
//        echo '</pre>';
//        print_r($numbers->next());
//        print_r($numbers->current());
//        echo '</pre>';
    }

    private function lazyRange(int $start, int $end): \Generator
    {
        echo 'Hello!';
        for ($i = $start; $i <= $end; $i++) {
            yield $i;
        }
    }
}
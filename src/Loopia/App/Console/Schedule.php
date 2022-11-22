<?php 

namespace Loopia\App\Console;

use Loopia\App\Api\FilmApiDataLoader;

class Schedule {

    public function __construct(protected FilmApiDataLoader $loader) {
        $this->loader = $loader;
    }

    public function run() {
        $this->loader->redisItems();
    }
}
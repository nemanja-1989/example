<?php 

namespace Loopia\App\Console\Commands;

use \Loopia\App\Console\Commands\Items\Items;

class Schedule {

    protected Items $items;

    public function __construct(Items $items) {
        $this->items = $items;
    }
    /**
     * @classes prepare for crontab
     */
    private function schedule() {
        $this->items->cacheItems();
    }

    /**
     * @crontab executable command
     */
    public function run() {
        return $this->schedule();
    }
       
} 
<?php 
require_once dirname(__DIR__) . '/vendor/autoload.php';
// $content = 'new content';

// $f=fopen('output.txt','w');
// fwrite($f,$content);
// fclose($f);

class Redis {
    public function redis() {
        return new \Predis\Client();
    }
}
<?php 

namespace Loopia\App\Containers;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Loopia\App\Api\FilmApiDataCache;
use Loopia\App\Api\FilmApiDataMemcache;
use Loopia\App\Api\Load;
use Loopia\App\ServiceModels\Memcache;
use Loopia\App\ServiceModels\Redis;
use Loopia\App\Services\MemcacheService;
use Loopia\App\Services\RedisService;
use Loopia\App\Console\Schedule;
use Loopia\App\ServiceModels\Client;
use Loopia\App\Services\HttpService;

class ContainerModel {

    protected ContainerBuilder $container;

    public function build() {
        $this->container = new ContainerBuilder();
        $this->container->set('Load', new Load(new Client, new RedisService, new Redis, new HttpService, new MemcacheService, new Memcache));
        $this->container->set('FilmApiDataMemcache', new FilmApiDataMemcache(new Load(new Client, new RedisService, new Redis, new HttpService, new MemcacheService, new Memcache), new MemcacheService, new Memcache));
        $this->container->set('FilmApiDataCache', new FilmApiDataCache(new Load(new Client, new RedisService, new Redis, new HttpService, new MemcacheService, new Memcache), new RedisService, new Redis));
        $this->container->set('Schedule', new Schedule(new $this, new RedisService, new Redis, new MemcacheService, new Memcache));
        $this->container->compile(true);
        return $this->container;
    }
}
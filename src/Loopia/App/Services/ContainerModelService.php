<?php 

namespace Loopia\App\Services;

use Loopia\App\Interface\ServiceInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ContainerModelService implements ServiceInterface {

    public function getService(string $url = null) :ContainerBuilder
    {
        return new ContainerBuilder();
    }
    
}
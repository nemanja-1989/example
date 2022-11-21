<?php 

namespace Loopia\App\Console\Commands\Items;

use \Loopia\App\Api\Client;
use Loopia\App\Api\Redis;

class Items {

    protected Client $itemClient;
    protected Redis $redis;

	public function __construct(Client $itemClient, Redis $redis) {
		$this->itemClient = $itemClient;
        $this->redis = $redis;
	}

    public function cacheItems() {
        $response = $this->filmApiClient->send($this->filmApiClient->getRequest('items'));
		$data =  $response->getBody()->getContents();
		$data = $this->redis->setCache('/v1/items', $data);
		$data = $this->redis->getCache('/v1/items');
		foreach(json_decode($data, TRUE) as $item) {
			$this->redis->setCache('/v1/item/' . $item['id'], json_encode($item));
		}
    }
}
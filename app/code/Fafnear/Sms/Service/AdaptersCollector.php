<?php

namespace Fafnear\Sms\Service;

use Fafnear\Sms\{
    Api\Data\Adapter,
    Helper\Config
};
use Magento\Framework\Data\Collection;
use Magento\Framework\Data\Collection\EntityFactoryInterface;

class AdaptersCollector extends Collection
{
    private $config;

    public function __construct(EntityFactoryInterface $entityFactory, Config $config, array $adapters = [])
    {
        array_walk($adapters, [$this, 'addItem']);
        $this->config = $config;
        parent::__construct($entityFactory);
        $this->_isCollectionLoaded = true;
    }

    public function getCurrent(): Adapter
    {
        return $this->getByName($this->config->getGetawayName());
    }

    public function getByName(string $name): Adapter
    {
        foreach ($this as $adapter) {
            if ($adapter->getName() == $name) {
                return $adapter;
            }
        }

        throw new \Exception('Adapter not found');
    }
}
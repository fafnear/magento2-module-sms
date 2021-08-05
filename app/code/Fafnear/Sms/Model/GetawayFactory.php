<?php

namespace Fafnear\Sms\Model;

use Magento\Framework\ObjectManagerInterface;
use Fafnear\Sms\{
    Api\Getaway,
    Service\AdaptersCollector
};

class GetawayFactory
{
    private $objectManager;
    private $adaptersCollector;

    public function __construct(ObjectManagerInterface $objectManager, AdaptersCollector $adaptersCollector)
    {
        $this->objectManager = $objectManager;
        $this->adaptersCollector = $adaptersCollector;
    }

    public function create()
    {
        return $this->objectManager->create(Getaway::class, [
            'adapter' => $this->adaptersCollector->getCurrent()
        ]);
    }
}
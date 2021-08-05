<?php

namespace Fafnear\Sms\Model\Config\Source;

use Fafnear\Core\Methods\OptionsToArrayMethod;
use Fafnear\Sms\Service\AdaptersCollector;

class Getaway
{
    use OptionsToArrayMethod;

    private $adaptersCollector;

    public function __construct(AdaptersCollector $adaptersCollector)
    {
        $this->adaptersCollector = $adaptersCollector;
    }

    public function toOptionArray()
    {
        $options = [];

        foreach ($this->adaptersCollector as $adapter) {
            $options[] = [
                'value' => $adapter->getName(),
                'label' => $adapter->getLabel()
            ];
        }

        return $options;
    }
}
<?php

namespace Fafnear\Sms\Service;

use Fafnear\Sms\Model\GetawayFactory;

class BalanceChecker
{
    protected $getawayFactory;

    public function __construct(GetawayFactory $getawayFactory)
    {
        $this->getawayFactory = $getawayFactory;
    }

    public function getBalance()
    {
        return $this->getawayFactory->create()->getBalance();
    }
}
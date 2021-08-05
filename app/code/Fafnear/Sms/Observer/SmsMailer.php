<?php

namespace Fafnear\Sms\Observer;

use Exception;
use Magento\Framework\{
    Event\ObserverInterface,
    Event\Observer
};
use Fafnear\Sms\{
    Service\MessageSender,
    Logger\Logger
};

abstract class SmsMailer implements ObserverInterface
{
    protected $service;
    protected $logger;

    public function __construct(MessageSender $service, Logger $logger)
    {
        $this->service = $service;
        $this->logger = $logger;
    }

    protected function send($number, Observer $observer, $vars = [])
    {
        $event = $observer->getEvent();
        $vars = empty($vars) ? $event->getData() : $vars;

        try {
            $this->service->send($event->getName(), $number, $vars);
        } catch (Exception $exception) {
            $this->logger->addError('Exception', compact('exception'));
        }
    }
}
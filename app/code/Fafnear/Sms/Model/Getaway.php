<?php

namespace Fafnear\Sms\Model;

use Fafnear\Sms\{
    Api\Getaway as IGetaway,
    Api\Message,
    Api\Data\Adapter,
    Api\Data\Response,
    Model\Getaway\Response\SendingDisabled
};
use Magento\Framework\ObjectManagerInterface;

class Getaway implements IGetaway
{
    const RESPONSE = SendingDisabled::class;

    protected $adapter;
    protected $objectManager;

    public function __construct(Adapter $adapter, ObjectManagerInterface $objectManager)
    {
        $this->adapter = $adapter;
        $this->objectManager = $objectManager;
    }

    public function send(Message $message, $number): Response
    {
        $text = $message->filter();
        $response = $this->makeResponse();

        if ($message->isEnabled()) {
            if (empty($text)) {
                $response->setData(SendingDisabled::KEY_ERROR_MESSAGE, __('The message is empty'));
            } else {
                $response = $this->adapter->send($number, $text);
            }
        }

        return $response;
    }

    public function getBalance(): ?float
    {
        return $this->adapter->getBalance();
    }

    protected function makeResponse()
    {
        return $this->objectManager->create(self::RESPONSE);
    }
}
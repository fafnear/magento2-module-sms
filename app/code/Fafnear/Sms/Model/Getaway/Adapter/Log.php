<?php

namespace Fafnear\Sms\Model\Getaway\Adapter;

use Fafnear\Sms\{
    Api\Data\Response,
    Model\Getaway\Adapter,
    Model\Getaway\Response\Logging
};

class Log extends Adapter
{
    const GETAWAY_NAME = 'log';
    const RESPONSE = Logging::class;

    protected $label = 'Log';
    protected $name = self::GETAWAY_NAME;

    public function send($number, string $message): Response
    {
        $requestData = compact('number', 'message');
        $result = $this->context->getLogger()->debug('Test sms sending', $requestData);

        return $this->makeResponse(json_encode($requestData))->setData(Logging::KEY_SUCCESS, $result);
    }

    public function getBalance(): ?float
    {
        return null;
    }
}
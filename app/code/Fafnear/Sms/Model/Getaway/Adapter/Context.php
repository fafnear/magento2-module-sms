<?php

namespace Fafnear\Sms\Model\Getaway\Adapter;

use GuzzleHttp\{
    ClientInterface,
    Client,
    HandlerStack,
    MessageFormatter,
    Middleware
};
use Fafnear\Sms\{
    Logger\Logger,
    Helper\Config
};
use Magento\Framework\ObjectManagerInterface;

class Context
{
    private $logger;
    private $config;
    private $objectManager;

    public function __construct(Logger $logger, Config $config, ObjectManagerInterface $objectManager)
    {
        $this->logger = $logger;
        $this->config = $config;
        $this->objectManager = $objectManager;
    }

    public function getLogger(): Logger
    {
        return $this->logger;
    }

    public function getConfig(): Config
    {
        return $this->config;
    }

    public function createHttpClient(): ClientInterface
    {
        $stack = HandlerStack::create();
        $stack->push(
            Middleware::log(
                $this->logger,
                new MessageFormatter('
URL: {url} 
method: {method}
code: {code}
request: {req_body}
response: {res_body}
')
            )
        );

        return new Client([
            'handler' => $stack
        ]);
    }

    public function getObjectManager(): ObjectManagerInterface
    {
        return $this->objectManager;
    }
}
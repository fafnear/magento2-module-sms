<?php

namespace Fafnear\Sms\Model\Message;

use Fafnear\Sms\Api\Message as IMessage;
use Magento\Framework\ObjectManagerInterface;

class Factory
{
    private $objectManager;
    private $messages;

    public function __construct(ObjectManagerInterface $objectManager, array $messages = [])
    {
        $this->objectManager = $objectManager;
        $this->messages = $messages;
    }

    public function create(string $name, array $variables = []): IMessage
    {
        return $this->objectManager->create(IMessage::class, compact('variables', 'name'));
    }
}
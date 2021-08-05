<?php

namespace Fafnear\Sms\Service;

use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\{
    Event\ManagerInterface,
    App\State,
    App\Area
};
use Fafnear\Sms\{
    Model\GetawayFactory,
    Model\Message\Factory as MessageFactory
};

class MessageSender
{
    const EVENT_NAME_SEND_BEFORE = 'fafnear_sms_send_before';
    const EVENT_NAME_SEND_AFTER = 'fafnear_sms_send_after';
    const EVENT_NAME_STATUS = 'fafnear_sms_status_%s';

    private $getawayFactory;
    private $messageFactory;

    protected $eventManager;
    protected $storeManager;
    protected $state;

    public function __construct(
        GetawayFactory $getawayFactory,
        MessageFactory $messageFactory,
        ManagerInterface $eventManager,
        StoreManagerInterface $storeManager,
        State $state
    ) {
        $this->getawayFactory = $getawayFactory;
        $this->messageFactory = $messageFactory;
        $this->eventManager = $eventManager;
        $this->storeManager = $storeManager;
        $this->state = $state;
    }

    public function send(string $template, $number, array $vars = [])
    {
        if (! isset($vars['store'])) {
            $vars['store'] = $this->getStore();
        }

        $message = $this->messageFactory->create($template, $vars);
        $eventArgs = compact('message', 'number');

        $this->fireEvent(self::EVENT_NAME_SEND_BEFORE, $eventArgs);

        $response = $this->getawayFactory->create()->send($message, $number);
        $eventArgs['response'] = $response;

        $this->fireEvent(self::EVENT_NAME_SEND_AFTER, $eventArgs);
        $this->fireEvent(sprintf(self::EVENT_NAME_STATUS, $response->getStatus()), $eventArgs);
    }

    protected function getStore()
    {
        if (in_array($this->state->getAreaCode(), [Area::AREA_ADMINHTML, Area::AREA_ADMIN])) {
            return $this->storeManager->getDefaultStoreView();
        }

        return $this->storeManager->getStore();
    }

    private function fireEvent(string $eventName, array $args = [])
    {
        $this->eventManager->dispatch($eventName, $args);
    }
}
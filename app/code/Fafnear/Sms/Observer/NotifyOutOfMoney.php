<?php

namespace Fafnear\Sms\Observer;

use Magento\Framework\{
    Event\ObserverInterface,
    Event\Observer
};
use Fafnear\Sms\Helper\Email;

class NotifyOutOfMoney implements ObserverInterface
{
    private $mailer;

    public function __construct(Email $mailer)
    {
        $this->mailer = $mailer;
    }

    public function execute(Observer $observer)
    {
        $this->mailer->notify(__('Not Enough Money'));
    }
}
<?php

namespace Fafnear\Sms\Observer;

use Magento\Framework\Event\Observer;

class CheckoutSubmitAllAfter extends SmsMailer
{
    public function execute(Observer $observer)
    {
        /**
         * @var \Magento\Sales\Model\Order $order
         */
        $order = $observer->getData('order');
        $number = $order->getShippingAddress()->getTelephone();
        $this->send($number, $observer);
    }
}
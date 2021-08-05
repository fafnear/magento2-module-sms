<?php

namespace Fafnear\Sms\Observer;

use Magento\Framework\Event\Observer;

class CustomerLogin extends SmsMailer
{
    public function execute(Observer $observer)
    {
        /**
         * @var \Magento\Customer\Model\Customer $customer
         */
        $customer = $observer->getData('customer');

        if ($address = $customer->getDefaultShippingAddress()) {
            $this->send((string)$address->getTelephone(), $observer);
        }
    }
}
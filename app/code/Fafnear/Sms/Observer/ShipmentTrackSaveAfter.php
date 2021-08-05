<?php

namespace Fafnear\Sms\Observer;

use Magento\Framework\Event\Observer;

class ShipmentTrackSaveAfter extends SmsMailer
{
    public function execute(Observer $observer)
    {
        /**
         * @var \Magento\Sales\Model\Order\Shipment\Track $track
         */
        $track = $observer->getData('track');
        $order = $track->getShipment()->getOrder();
        $shipment = $track->getShipment();
        $number = (string)$track->getShipment()->getShippingAddress()->getTelephone();
        $vars = compact('track', 'order', 'shipment');

        $this->send($number, $observer, $vars);
    }
}
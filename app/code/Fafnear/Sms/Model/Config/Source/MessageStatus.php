<?php

namespace Fafnear\Sms\Model\Config\Source;

use Fafnear\Core\Methods\OptionsToArrayMethod;

class MessageStatus
{
    use OptionsToArrayMethod;

    const MESSAGE_STATUS_UNKNOWN = 'unknown';
    const MESSAGE_STATUS_SUCCESS = 'success';
    const MESSAGE_STATUS_ERROR = 'error';
    const MESSAGE_STATUS_NOT_ENOUGH_MONEY = 'not_enough_money';

    public function toOptionArray()
    {
        $options[] = [
            'value' => self::MESSAGE_STATUS_UNKNOWN,
            'label' => __('Unknown')
        ];
        $options[] = [
            'value' => self::MESSAGE_STATUS_SUCCESS,
            'label' => __('Success')
        ];
        $options[] = [
            'value' => self::MESSAGE_STATUS_ERROR,
            'label' => __('Error')
        ];
        $options[] = [
            'value' => self::MESSAGE_STATUS_NOT_ENOUGH_MONEY,
            'label' => __('Not enough money')
        ];

        return $options;
    }
}
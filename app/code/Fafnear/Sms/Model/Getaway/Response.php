<?php

namespace Fafnear\Sms\Model\Getaway;

use Fafnear\Sms\{
    Api\Data\Adapter,
    Api\Data\Response as IResponse
};
use Magento\Framework\DataObject;

abstract class Response extends DataObject implements IResponse
{
    const KEY_ADAPTER = 'adapter';
    const KEY_MESSAGE_ID = 'message_id';
    const KEY_ERROR_MESSAGE = 'error_message';
    const KEY_REQUEST_DATA = 'request_data';
    const KEY_RESPONSE_DATA = 'response_data';
    const KEY_SUCCESS = 'success_flag';
    const KEY_STATUS = 'status';

    public function isSuccess(): bool
    {
        return $this->getData(self::KEY_SUCCESS);
    }

    public function getAdapter(): Adapter
    {
        return $this->getData(self::KEY_ADAPTER);
    }

    public function getErrorMessage(): ?string
    {
        return $this->getData(static::KEY_ERROR_MESSAGE);
    }

    public function getMessageId(): ?string
    {
        return $this->getData(self::KEY_MESSAGE_ID);
    }

    public function getRequestData(): string
    {
        return $this->getData(static::KEY_REQUEST_DATA);
    }

    public function getResponseData(): ?string
    {
        return $this->getData(static::KEY_RESPONSE_DATA);
    }

    public function getStatus()
    {
        return $this->getData(static::KEY_STATUS);
    }
}
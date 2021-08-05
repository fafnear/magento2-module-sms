<?php

namespace Fafnear\Sms\Model\Getaway\Response;

use Fafnear\Sms\Model\Getaway\Response;

class SendingDisabled extends Response
{
    public function isSuccess(): bool
    {
        return false;
    }

    public function getErrorMessage(): ?string
    {
        return parent::getErrorMessage() ?: __('Message sending disabled.');
    }
}
<?php

namespace Fafnear\Sms\Model\Getaway\Response;

use Fafnear\Sms\Model\Getaway\Response;

class Logging extends Response
{
    public function getErrorMessage(): ?string
    {
        return __('Message sending disabled.');
    }
}
<?php

namespace Fafnear\Sms\Api;

use Zend_Filter_Interface;

interface Message extends Zend_Filter_Interface
{
    public function isEnabled(): bool;
    public function getTemplate(): string;
    public function filter($value = null);
}
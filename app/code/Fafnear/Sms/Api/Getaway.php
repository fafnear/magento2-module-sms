<?php

namespace Fafnear\Sms\Api;

interface Getaway
{
    public function send(Message $message, $number): Data\Response;
    public function getBalance(): ?float;
}
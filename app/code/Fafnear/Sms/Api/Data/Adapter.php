<?php

namespace Fafnear\Sms\Api\Data;

interface Adapter
{
    public function send($number, string $message): Response;
    public function getBalance(): ?float;
    public function getName(): string;
    public function getLabel(): string;
}
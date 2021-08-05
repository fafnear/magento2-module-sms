<?php

namespace Fafnear\Sms\Api\Data;

interface Response
{
    public function getRequestData(): string;
    public function getResponseData(): ?string;
    public function isSuccess(): bool;
    public function getErrorMessage(): ?string;
    public function getMessageId(): ?string;
    public function getStatus();
    public function getAdapter(): Adapter;
}
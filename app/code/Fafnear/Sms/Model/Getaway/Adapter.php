<?php

namespace Fafnear\Sms\Model\Getaway;

use Fafnear\Sms\{
    Api\Data\Response,
    Api\Data\Adapter as IAdapter,
    Model\Getaway\Response as BaseResponse
};
use Magento\Framework\DataObject;

abstract class Adapter extends DataObject implements IAdapter
{
    const RESPONSE = null;

    protected $name;
    protected $label;
    protected $context;

    public function __construct(Adapter\Context $context, array $data = [])
    {
        $this->context = $context;
        parent::__construct($data);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    protected function makeResponse($requestData, $responseData = null): Response
    {
        return $this->context->getObjectManager()->create(static::RESPONSE, [
            'data' => [
                BaseResponse::KEY_REQUEST_DATA => $requestData,
                BaseResponse::KEY_RESPONSE_DATA => $responseData,
                BaseResponse::KEY_ADAPTER => $this
            ]
        ]);
    }
}
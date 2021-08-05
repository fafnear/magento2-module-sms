<?php

namespace Fafnear\Sms\Model;

use Fafnear\Sms\{
    Api\Message as IMessage,
    Model\Message\Context
};
use Magento\Framework\{
    App\Config\ScopeConfigInterface,
    Filter\Template,
    Filter\VariableResolverInterface,
    Stdlib\StringUtils
};

class Message extends Template implements IMessage
{
    const XML_PATH_TYPE_ENABLED = 'enabled';
    const XML_PATH_TYPE_TEMPLATE = 'template';

    private $context;
    private $name;

    public function __construct(
        Context $context,
        string $name,
        StringUtils $string,
        $variables = [],
        $directiveProcessors = [],
        VariableResolverInterface $variableResolver = null
    ) {
        $this->context = $context;
        $this->name = $name;
        parent::__construct($string, $variables, $directiveProcessors, $variableResolver);
    }

    public function isEnabled($scopeType = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $scopeCode = null): bool
    {
        if (! $this->context->getConfig()->isEnabled($scopeType, $scopeCode)) {
            return false;
        }

        return $this->context->getScopeConfig()->isSetFlag($this->getXmlPathEnabled(), $scopeType, $scopeCode);
    }

    public function getTemplate($scopeType = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $scopeCode = null): string
    {
        return $this->context->getScopeConfig()->getValue($this->getXmlPathTemplate(), $scopeType, $scopeCode);
    }

    public function filter($value = null)
    {
        if ($value === null) {
            $value = $this->getTemplate();
        }

        return parent::filter($value);
    }

    public function getXmlPathEnabled(): string
    {
        return $this->getXmlTemplatePath(self::XML_PATH_TYPE_ENABLED);
    }

    public function getXmlPathTemplate(): string
    {
        return $this->getXmlTemplatePath(self::XML_PATH_TYPE_TEMPLATE);
    }

    public function getXmlTemplatePath(string $type): string
    {
        return "fafnear_sms/templates/{$this->name}_{$type}";
    }
}
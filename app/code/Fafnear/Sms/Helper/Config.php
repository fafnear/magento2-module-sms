<?php

namespace Fafnear\Sms\Helper;

use Magento\Framework\{
    App\Config\ScopeConfigInterface,
    App\Helper\AbstractHelper
};

class Config extends AbstractHelper
{
    const XML_PATH_GENERAL_ENABLED = 'fafnear_sms/general/enabled';
    const XML_PATH_GENERAL_GETAWAY = 'fafnear_sms/general/getaway';
    const XML_PATH_LOG_FILENAME = 'fafnear_sms/general/log_filename';

    public function isEnabled(string $scopeType = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $scopeCode = null)
    {
        return $this->scopeConfig->getValue(self::XML_PATH_GENERAL_ENABLED, $scopeType, $scopeCode);
    }

    public function getGetawayName(string $scopeType = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $scopeCode = null)
    {
        return $this->scopeConfig->getValue(self::XML_PATH_GENERAL_GETAWAY, $scopeType, $scopeCode);
    }

    public function getLogFilename(string $scopeType = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $scopeCode = null)
    {
        return $this->scopeConfig->getValue(self::XML_PATH_LOG_FILENAME, $scopeType, $scopeCode);
    }
}
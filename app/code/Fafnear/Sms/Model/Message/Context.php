<?php

namespace Fafnear\Sms\Model\Message;

use Magento\Framework\App\Helper\Context as BaseContext;
use Fafnear\Sms\Helper\Config;

class Context extends BaseContext
{
    private $config;

    public function __construct(
        Config $config,
        \Magento\Framework\Url\EncoderInterface $urlEncoder,
        \Magento\Framework\Url\DecoderInterface $urlDecoder,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Module\Manager $moduleManager,
        \Magento\Framework\App\RequestInterface $httpRequest,
        \Magento\Framework\Cache\ConfigInterface $cacheConfig,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Framework\HTTP\Header $httpHeader,
        \Magento\Framework\HTTP\PhpEnvironment\RemoteAddress $remoteAddress,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->config = $config;
        parent::__construct($urlEncoder, $urlDecoder, $logger, $moduleManager, $httpRequest, $cacheConfig, $eventManager, $urlBuilder, $httpHeader, $remoteAddress, $scopeConfig);
    }

    public function getConfig()
    {
        return $this->config;
    }
}
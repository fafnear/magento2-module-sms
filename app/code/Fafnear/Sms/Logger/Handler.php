<?php

namespace Fafnear\Sms\Logger;

use Magento\Framework\{
    Filesystem\DriverInterface,
    Logger\Handler\Base
};
use Fafnear\Sms\Helper\Config;

class Handler extends Base
{
    protected $loggerType = Logger::DEBUG;

    public function __construct(
        Config $config,
        DriverInterface $filesystem,
        $filePath = null,
        $fileName = null
    ) {
        $this->fileName = "/var/log/{$config->getLogFilename()}";
        parent::__construct($filesystem, $filePath, $fileName);
    }
}
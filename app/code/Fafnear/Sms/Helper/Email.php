<?php

namespace Fafnear\Sms\Helper;

use Exception;
use Fafnear\Sms\Logger\Logger;
use Magento\Framework\{
    Escaper,
    App\Helper\Context,
    App\Helper\AbstractHelper,
    Mail\Template\TransportBuilder,
    Translate\Inline\StateInterface
};

class Email extends AbstractHelper
{
    const XML_PATH_RECIPIENTS = 'fafnear_sms/general/recipients';
    const XML_PATH_SENDER_NAME = 'trans_email/ident_general/name';
    const XML_PATH_SENDER_EMAIL = 'trans_email/ident_general/email';
    const TEMPLATE_NOTIFICATION = 'fafnear_sms_notification';

    protected $inlineTranslation;
    protected $escaper;
    protected $transportBuilder;
    protected $logger;

    public function __construct(
        Context $context,
        Logger $logger,
        StateInterface $inlineTranslation,
        Escaper $escaper,
        TransportBuilder $transportBuilder
    ) {
        parent::__construct($context);
        $this->inlineTranslation = $inlineTranslation;
        $this->escaper = $escaper;
        $this->transportBuilder = $transportBuilder;
        $this->logger = $logger;
    }

    public function notify(string $message, ...$emails)
    {
        $emails = $emails ? array_unique($emails) : $this->getRecipients();

        if (empty($emails)) {
            return;
        }

        try {
            $this->inlineTranslation->suspend();
            $builder = $this->transportBuilder
                ->setTemplateIdentifier($this->getNotificationTemplate())
                ->setTemplateOptions(
                    [
                        'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                        'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID
                    ]
                )
                ->setTemplateVars(compact('message'))
                ->setFrom($this->getSender());
            array_walk($emails, function ($email) use ($builder) {
                $builder->addTo($email);
            });
            $builder->getTransport()->sendMessage();
        } catch (Exception $exception) {
            $this->logger->addCritical('Email exception', compact('exception'));
        } finally {
            $this->inlineTranslation->resume();
        }
    }

    public function getRecipients(): array
    {
        $emails = $this->scopeConfig->getValue(self::XML_PATH_RECIPIENTS);
        $emails = explode(',', $emails);
        $emails = array_map('trim', $emails);
        $emails = array_filter($emails, function($email) {
            return ! empty($email);
        });
        $emails = array_unique($emails);

        return $emails;
    }

    public function getSender(): array
    {
        return [
            'name' => $this->escaper->escapeHtml($this->scopeConfig->getValue(self::XML_PATH_SENDER_NAME)),
            'email' => $this->escaper->escapeHtml($this->scopeConfig->getValue(self::XML_PATH_SENDER_EMAIL))
        ];
    }

    public function getNotificationTemplate()
    {
        return self::TEMPLATE_NOTIFICATION;
    }
}
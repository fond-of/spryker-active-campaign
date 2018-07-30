<?php

namespace FondOfSpryker\Zed\ActiveCampaign;

use FondOfSpryker\Shared\ActiveCampaign\ActiveCampaignConstants;
use Generated\Shared\Transfer\ActiveCampaignRequestTransfer;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class ActiveCampaignConfig extends AbstractBundleConfig
{
    const DEFAULT_LOCALE = 'de_DE';

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var string
     */
    private $url;

    /**
     * @var integer
     */
    private $formId;

    /**
     * @var integer
     */
    private $listId;

    /**
     * @var string
     */
    private $subscribeUrl;

    /**
     * @var string
     */
    private $subcribeConfirmUrl;

    /**
     * @var string|null
     */
    private $locale = null;

    /**
     * @param \Generated\Shared\Transfer\ActiveCampaignRequestTransfer $transfer
     *
     * @return $this
     */
    public function initByTransfer(ActiveCampaignRequestTransfer $transfer)
    {
        $this->locale = $transfer->getLocale();

        $this->apiKey = $this->get(ActiveCampaignConstants::ACTIVE_CAMPAIGN_API_KEY);
        $this->url = $this->get(ActiveCampaignConstants::ACTIVE_CAMPAIGN_URL);
        $this->formId = $this->get(ActiveCampaignConstants::ACTIVE_CAMPAIGN_FORMID . $this->locale);
        $this->listId = $this->get(ActiveCampaignConstants::ACTIVE_CAMPAIGN_LISTID . $this->locale);
        $this->subscribeUrl = $this->get(ActiveCampaignConstants::ACTIVE_CAMPAIGN_SUBSCRIBE_URL);
        $this->subcribeConfirmUrl = $this->get(ActiveCampaignConstants::ACTIVE_CAMPAIGN_CONFIRMATION_URL);

        return $this;
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return int
     */
    public function getFormId(): int
    {
        return $this->formId;
    }

    /**
     * @return int
     */
    public function getListId(): int
    {
        return $this->listId;
    }

    /**
     * @return string
     */
    public function getSubscribeUrl(): string
    {
        return $this->subscribeUrl;
    }

    /**
     * @return string
     */
    public function getSubscribeConfirmUrl(): string
    {
        return $this->subcribeConfirmUrl;
    }
}

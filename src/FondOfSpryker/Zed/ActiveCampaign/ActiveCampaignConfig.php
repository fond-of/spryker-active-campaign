<?php

namespace FondOfSpryker\Zed\ActiveCampaign;

use FondOfSpryker\Shared\ActiveCampaign\ActiveCampaignConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class ActiveCampaignConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->get(ActiveCampaignConstants::ACTIVE_CAMPAIGN_API_KEY);
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->get(ActiveCampaignConstants::ACTIVE_CAMPAIGN_URL);
    }

    /**
     * @param string $locale
     *
     * @return int
     */
    public function getFormId(string $locale): int
    {
        return $this->getLocalized(ActiveCampaignConstants::ACTIVE_CAMPAIGN_FORM_ID, $locale);
    }

    /**
     * @param string $locale
     *
     * @return int
     */
    public function getListId(string $locale): int
    {
        return $this->getLocalized(ActiveCampaignConstants::ACTIVE_CAMPAIGN_LIST_ID, $locale);
    }

    /**
     * @param string $locale
     *
     * @return string
     */
    public function getSubscribePathPart(string $locale): string
    {
        return $this->getLocalized(ActiveCampaignConstants::ACTIVE_CAMPAIGN_SUBSCRIBE_PATH, $locale);
    }

    /**
     * @param string $locale
     *
     * @return string
     */
    public function getConfirmationPathPart(string $locale): string
    {
        return $this->getLocalized(ActiveCampaignConstants::ACTIVE_CAMPAIGN_CONFIRMATION_PATH, $locale);
    }

    /**
     * @param string $key
     * @param string $locale
     * @param mixed $default
     *
     * @return mixed
     */
    protected function getLocalized(string $key, string $locale, $default = null)
    {
        $localizedConfigs = $this->get(ActiveCampaignConstants::ACTIVE_CAMPAIGN_LOCALIZED_CONFIGS, []);

        if (!\is_array($localizedConfigs) || empty($localizedConfigs)) {
            return $default;
        }

        if (!\array_key_exists($locale, $localizedConfigs) || !\is_array($localizedConfigs[$locale])) {
            return $default;
        }

        $configs = $localizedConfigs[$locale];

        if (!\array_key_exists($key, $configs)) {
            return $default;
        }

        return $configs[$key];
    }
}

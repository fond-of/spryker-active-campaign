<?php

namespace FondOfSpryker\Yves\ActiveCampaign;

use FondOfSpryker\Shared\ActiveCampaign\ActiveCampaignConstants;
use Spryker\Yves\Kernel\AbstractBundleConfig;

class ActiveCampaignConfig extends AbstractBundleConfig
{
    /**
     * @param string $locale
     *
     * @return string
     */
    public function getSubscribePath(string $locale): string
    {
        return $this->getLocalized(ActiveCampaignConstants::ACTIVE_CAMPAIGN_SUBSCRIBE_PATH, $locale);
    }

    /**
     * @param string $locale
     *
     * @return string
     */
    public function getConfirmationPath(string $locale): string
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

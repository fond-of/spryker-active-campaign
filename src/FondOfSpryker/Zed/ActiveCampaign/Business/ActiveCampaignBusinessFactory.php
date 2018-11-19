<?php

namespace FondOfSpryker\Zed\ActiveCampaign\Business;

use FondOfSpryker\Zed\ActiveCampaign\Business\Api\ActiveCampaignApi;
use FondOfSpryker\Zed\ActiveCampaign\Business\Service\ContactService;
use FondOfSpryker\Zed\ActiveCampaign\Business\Subscription\SubscriptionHandler;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\ActiveCampaign\ActiveCampaignConfig getConfig()
 */
class ActiveCampaignBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\ActiveCampaign\Business\Subscription\SubscriptionHandler
     */
    public function createSubscriptionHandler()
    {
        return new SubscriptionHandler(
            $this->getConfig(),
            $this->createContactService()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\ActiveCampaign\Business\Service\ContactService
     */
    public function createContactService(): ContactService
    {
        $api = new ActiveCampaignApi($this->getConfig()->getUrl(), $this->getConfig()->getApiKey());

        return $api->getContactService();
    }
}

<?php

namespace FondOfSpryker\Zed\ActiveCampaign\Business;

use FondOfSpryker\Zed\ActiveCampaign\Business\Api\ActiveCampaignApi;
use FondOfSpryker\Zed\ActiveCampaign\Business\Subscription\SubscriptionHandler;
use Generated\Shared\Transfer\ActiveCampaignRequestTransfer;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\ActiveCampaign\ActiveCampaignConfig getConfig()
 */
class ActiveCampaignBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @param \Generated\Shared\Transfer\ActiveCampaignRequestTransfer $activeCampaignRequestTransfer
     *
     * @return \FondOfSpryker\Zed\ActiveCampaign\Business\Subscription\SubscriptionHandler
     */
    public function createSubscriptionHandler(ActiveCampaignRequestTransfer $activeCampaignRequestTransfer)
    {
        return new SubscriptionHandler(
            $this->getActiveCampaignConfig($activeCampaignRequestTransfer),
            $this->createContactService(),
            $activeCampaignRequestTransfer
        );
    }

    /**
     * @param \Generated\Shared\Transfer\ActiveCampaignRequestTransfer $activeCampaignRequestTransfer
     *
     * @return \Spryker\Zed\Kernel\AbstractBundleConfig
     */
    protected function getActiveCampaignConfig(ActiveCampaignRequestTransfer $activeCampaignRequestTransfer)
    {
        return $this->getConfig()->initByTransfer($activeCampaignRequestTransfer);
    }

    /**
     * @return \FondOfSpryker\Zed\ActiveCampaign\Business\Service\ContactService
     */
    public function createContactService()
    {
        $api = new ActiveCampaignApi(
            $this->getConfig()->getUrl(),
            $this->getConfig()->getApiKey()
        );

        return $api->getContactService();
    }
}

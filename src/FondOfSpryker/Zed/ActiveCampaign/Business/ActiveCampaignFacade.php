<?php

namespace FondOfSpryker\Zed\ActiveCampaign\Business;

use Generated\Shared\Transfer\ActiveCampaignRequestTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\ActiveCampaign\Business\ActiveCampaignBusinessFactory getFactory()
 */
class ActiveCampaignFacade extends AbstractFacade implements ActiveCampaignFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\ActiveCampaignRequestTransfer $activeCampaignRequestTransfer
     *
     * @return void
     */
    public function subscribeToActiveCampaign(ActiveCampaignRequestTransfer $activeCampaignRequestTransfer): void
    {
        $this->getFactory()->createSubscriptionHandler()->processNewsletterSubscriptions($activeCampaignRequestTransfer);
    }
}

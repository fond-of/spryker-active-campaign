<?php

namespace FondOfSpryker\Zed\ActiveCampaign\Business;

use Generated\Shared\Transfer\ActiveCampaignRequestTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * Class ActiveCampaignFacade
 * @package FondOfSpryker\Zed\ActiveCampaign\Business
 * @method \FondOfSpryker\Zed\ActiveCampaign\Business\ActiveCampaignBusinessFactory getFactory()
 */
class ActiveCampaignFacade extends AbstractFacade implements ActiveCampaignFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\ActiveCampaignRequestTransfer $activeCampaignRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ActiveCampaignResponseTransfer|void
     */
    public function subscribeToActiveCampaign(ActiveCampaignRequestTransfer $activeCampaignRequestTransfer)
    {
        return $this->getFactory()
            ->createSubscriptionHandler($activeCampaignRequestTransfer)
            ->processNewsletterSubscriptions();
    }
}

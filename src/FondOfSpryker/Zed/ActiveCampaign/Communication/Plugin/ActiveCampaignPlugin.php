<?php

namespace FondOfSpryker\Zed\ActiveCampaign\Communication\Plugin;

use Generated\Shared\Transfer\ActiveCampaignRequestTransfer;
use Generated\Shared\Transfer\ActiveCampaignResponseTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\ActiveCampaign\Business\ActiveCampaignFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\ActiveCampaign\Business\ActiveCampaignBusinessFactory getFactory()
 */
class ActiveCampaignPlugin extends AbstractPlugin
{
    /**
     * @param \Generated\Shared\Transfer\ActiveCampaignRequestTransfer $activeCampaignRequestTransfer
     * @return \Generated\Shared\Transfer\ActiveCampaignResponseTransfer|null
     */
    public function subscribeToActiveCampaign(ActiveCampaignRequestTransfer $activeCampaignRequestTransfer): ?ActiveCampaignResponseTransfer
    {
        return $this->getFacade()->subscribeToActiveCampaign($activeCampaignRequestTransfer);
    }
}

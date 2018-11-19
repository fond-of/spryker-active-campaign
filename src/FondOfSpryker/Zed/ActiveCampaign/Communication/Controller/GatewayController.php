<?php

namespace FondOfSpryker\Zed\ActiveCampaign\Communication\Controller;

use Generated\Shared\Transfer\ActiveCampaignRequestTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfSpryker\Zed\ActiveCampaign\Business\ActiveCampaignFacade getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\ActiveCampaignRequestTransfer $activeCampaignRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ActiveCampaignRequestTransfer
     */
    public function subscribeAction(ActiveCampaignRequestTransfer $activeCampaignRequestTransfer)
    {
        $this->getFacade()->subscribeToActiveCampaign($activeCampaignRequestTransfer);

        return $activeCampaignRequestTransfer;
    }
}

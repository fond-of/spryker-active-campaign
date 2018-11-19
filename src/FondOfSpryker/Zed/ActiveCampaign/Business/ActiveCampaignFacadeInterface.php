<?php

namespace FondOfSpryker\Zed\ActiveCampaign\Business;

use Generated\Shared\Transfer\ActiveCampaignRequestTransfer;

interface ActiveCampaignFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\ActiveCampaignRequestTransfer $activeCampaignRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ActiveCampaignResponseTransfer
     */
    public function subscribeToActiveCampaign(ActiveCampaignRequestTransfer $activeCampaignRequestTransfer);
}

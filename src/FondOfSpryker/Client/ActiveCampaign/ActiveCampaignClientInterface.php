<?php

namespace FondOfSpryker\Client\ActiveCampaign;

use Generated\Shared\Transfer\ActiveCampaignRequestTransfer;

interface ActiveCampaignClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\ActiveCampaignRequestTransfer $activeCampaignRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ActiveCampaignRequestTransfer
     */
    public function subscribe(ActiveCampaignRequestTransfer $activeCampaignRequestTransfer): ActiveCampaignRequestTransfer;
}

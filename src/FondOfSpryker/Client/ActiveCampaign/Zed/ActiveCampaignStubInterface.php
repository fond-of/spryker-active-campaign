<?php

namespace FondOfSpryker\Client\ActiveCampaign\Zed;

use Generated\Shared\Transfer\ActiveCampaignRequestTransfer;

interface ActiveCampaignStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\ActiveCampaignRequestTransfer $activeCampaignRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ActiveCampaignRequestTransfer
     */
    public function subscribe(ActiveCampaignRequestTransfer $activeCampaignRequestTransfer): ActiveCampaignRequestTransfer;
}

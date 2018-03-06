<?php

namespace FondOfSpryker\Client\ActiveCampaign;

use Generated\Shared\Transfer\ActiveCampaignRequestTransfer;

interface ActiveCampaignClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\ActiveCampaignRequestTransfer $activeCampaignRequestTransfer
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function subscribe(ActiveCampaignRequestTransfer $activeCampaignRequestTransfer);
}

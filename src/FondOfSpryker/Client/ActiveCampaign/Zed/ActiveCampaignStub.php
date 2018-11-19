<?php

namespace FondOfSpryker\Client\ActiveCampaign\Zed;

use Generated\Shared\Transfer\ActiveCampaignRequestTransfer;
use Spryker\Client\ZedRequest\Stub\ZedRequestStub;

class ActiveCampaignStub extends ZedRequestStub implements ActiveCampaignStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\ActiveCampaignRequestTransfer $activeCampaignRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ActiveCampaignRequestTransfer
     */
    public function subscribe(ActiveCampaignRequestTransfer $activeCampaignRequestTransfer): ActiveCampaignRequestTransfer
    {
        return $this->zedStub->call('/active-campaign/gateway/subscribe', $activeCampaignRequestTransfer);
    }
}

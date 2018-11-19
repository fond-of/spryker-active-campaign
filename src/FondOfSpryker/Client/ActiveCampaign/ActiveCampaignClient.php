<?php

namespace FondOfSpryker\Client\ActiveCampaign;

use Generated\Shared\Transfer\ActiveCampaignRequestTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfSpryker\Client\ActiveCampaign\ActiveCampaignFactory getFactory()
 */
class ActiveCampaignClient extends AbstractClient implements ActiveCampaignClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\ActiveCampaignRequestTransfer $activeCampaignRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ActiveCampaignRequestTransfer
     */
    public function subscribe(ActiveCampaignRequestTransfer $activeCampaignRequestTransfer): ActiveCampaignRequestTransfer
    {
        return $this->getFactory()->createActiveCampaignStub()->subscribe($activeCampaignRequestTransfer);
    }
}

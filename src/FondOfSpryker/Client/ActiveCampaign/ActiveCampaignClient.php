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
     * @return Zed\ActiveCampaignStub
     */
    protected function getZedStub()
    {
        return $this->getFactory()->createZedStub();
    }

    /**
     * @param \Generated\Shared\Transfer\ActiveCampaignRequestTransfer $activeCampaignRequestTransfer
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function subscribe(ActiveCampaignRequestTransfer $activeCampaignRequestTransfer)
    {
        $response = $this->getFactory()
            ->createZedStub()
            ->subscribe($activeCampaignRequestTransfer);

        return $response;
    }
}

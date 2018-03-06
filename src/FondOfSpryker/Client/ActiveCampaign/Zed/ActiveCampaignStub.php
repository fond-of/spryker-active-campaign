<?php

namespace FondOfSpryker\Client\ActiveCampaign\Zed;

use Generated\Shared\Transfer\ActiveCampaignRequestTransfer;
use Spryker\Client\ZedRequest\Stub\ZedRequestStub;
use Spryker\Client\ZedRequest\ZedRequestClient;
use Spryker\Shared\Kernel\Transfer\TransferInterface;

class ActiveCampaignStub extends ZedRequestStub implements ActiveCampaignStubInterface
{
    /**
     * @var \Spryker\Client\ZedRequest\ZedRequestClient
     */
    protected $zedStub;

    /**
     * @param \Spryker\Client\ZedRequest\ZedRequestClient $zedStub
     */
    public function __construct(ZedRequestClient $zedStub)
    {
        $this->zedStub = $zedStub;
    }

    /**
     * @param \Generated\Shared\Transfer\ActiveCampaignRequestTransfer $activeCampaignRequestTransfer
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function subscribe(ActiveCampaignRequestTransfer $activeCampaignRequestTransfer): TransferInterface
    {
        return $this->zedStub->call(
            '/active-campaign/gateway/subscribe',
            $activeCampaignRequestTransfer
        );
    }
}

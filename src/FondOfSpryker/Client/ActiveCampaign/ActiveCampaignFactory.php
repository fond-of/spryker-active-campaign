<?php

namespace FondOfSpryker\Client\ActiveCampaign;

use FondOfSpryker\Client\ActiveCampaign\Zed\ActiveCampaignStub;
use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\ZedRequest\ZedRequestClientInterface;

class ActiveCampaignFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Client\ActiveCampaign\Zed\ActiveCampaignStub
     */
    public function createZedStub()
    {
        return new ActiveCampaignStub($this->getZedRequestClient());
    }

    /**
     * @return \Spryker\Client\ZedRequest\ZedRequestClientInterface
     */
    public function getZedRequestClient(): ZedRequestClientInterface
    {
        return $this->getProvidedDependency(ActiveCampaignDependencyProvider::CLIENT_ZED_REQUEST);
    }
}

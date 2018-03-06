<?php

namespace FondOfSpryker\Client\ActiveCampaign;

use FondOfSpryker\Client\ActiveCampaign\Zed\ActiveCampaignStub;
use Spryker\Client\Kernel\AbstractFactory;

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
     * @return mixed
     */
    public function getZedRequestClient()
    {
        return $this->getProvidedDependency(ActiveCampaignDependencyProvider::CLIENT_ZED_REQUEST);
    }
}

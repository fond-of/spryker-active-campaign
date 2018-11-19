<?php

namespace FondOfSpryker\Zed\ActiveCampaign\Business\Api;

use FondOfPHP\ActiveCampaign\Api;
use FondOfSpryker\Zed\ActiveCampaign\Business\Service\ContactService;

class ActiveCampaignApi extends Api
{
    protected const SERVICE_CONTACT = 'SERVICE_CONTACT';

    /**
     * @return \FondOfSpryker\Zed\ActiveCampaign\Business\Service\ContactService
     */
    public function getContactService(): ContactService
    {
        if (!array_key_exists(static::SERVICE_CONTACT, $this->services)) {
            $this->services[static::SERVICE_CONTACT] = new ContactService($this->httpClient, $this->key);
        }

        return $this->services[static::SERVICE_CONTACT];
    }
}

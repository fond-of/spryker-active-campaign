<?php

namespace FondOfSpryker\Zed\ActiveCampaign\Business\Api;

use FondOfPHP\ActiveCampaign\Api;
use FondOfSpryker\Zed\ActiveCampaign\Business\Service\ContactService;

class ActiveCampaignApi extends Api
{
    const CONTACT_KEY = 'contact';

    /**
     * ActiveCampaignApi constructor.
     *
     * @param string $baseUri
     * @param string $key
     */
    public function __construct($baseUri, $key)
    {
        parent::__construct($baseUri, $key);
    }

    /**
     * @return \FondOfPHP\ActiveCampaign\Service\Contact
     */
    public function getContactService()
    {
        if (!array_key_exists(self::CONTACT_KEY, $this->services)) {
            $this->services[self::CONTACT_KEY] = new ContactService($this->httpClient, $this->key);
        }

        return $this->services[self::CONTACT_KEY];
    }
}

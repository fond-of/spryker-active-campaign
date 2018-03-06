<?php

namespace FondOfSpryker\Zed\ActiveCampaign\Business\Service;

use FondOfBags\ActiveCampaign\Service\Contact;
use GuzzleHttp\Client;

class ContactService extends Contact
{
    /**
     * ContactService constructor.
     *
     * @param \GuzzleHttp\Client $httpClient
     * @param string $apiKey
     */
    public function __construct(Client $httpClient, string $apiKey)
    {
        parent::__construct($httpClient, $apiKey);
    }

    /**
     * @param \FondOfBags\ActiveCampaign\Service\Contact $contact
     *
     * @return void
     */
    public function linkContactToList(Contact $contact): void
    {
        $arrayOfLists = $contact->getLists();
    }
}

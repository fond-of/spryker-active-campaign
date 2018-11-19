<?php

namespace FondOfSpryker\Zed\ActiveCampaign\Business\Service;

use FondOfPHP\ActiveCampaign\DataTransferObject\Contact as ContactTransfer;
use FondOfPHP\ActiveCampaign\Service\Contact;
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
     * @param \FondOfPHP\ActiveCampaign\DataTransferObject\Contact $contact
     * @param int $linkListId
     *
     * @return void
     */
    public function linkContactToList(ContactTransfer $contact, int $linkListId): void
    {
        $params = $this->getListAndStatusParam($contact->getLists());

        $response = $this->update(
            array_merge(
                $params,
                [
                    'id' => $contact->getId(),
                    'email' => $contact->getEmail(),
                    'p[' . $linkListId . ']' => $linkListId,
                    'status[' . $linkListId . ']' => 1,
                ]
            )
        );
    }

    /**
     * @param array $lists
     *
     * @return array
     */
    private function getListAndStatusParam(array $lists): array
    {
        $listIds = [];

        if (count($lists) <= 0) {
            return $listIds;
        }

        /** @var \FondOfPHP\ActiveCampaign\DataTransferObject\ContactMailingListRelation $transfer */
        foreach ($lists as $transfer) {
            $listIds['p[' . $transfer->getListId() . ']'] = (int)$transfer->getListId();
            $listIds['status[' . $transfer->getListId() . ']'] = (int)$transfer->getStatus();
        }

        return $listIds;
    }
}

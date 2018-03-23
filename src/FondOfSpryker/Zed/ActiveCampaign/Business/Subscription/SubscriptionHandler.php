<?php

namespace FondOfSpryker\Zed\ActiveCampaign\Business\Subscription;

use Doctrine\Common\Annotations\AnnotationRegistry;
use FondOfPHP\ActiveCampaign\DataTransferObject\Contact;
use FondOfSpryker\Zed\ActiveCampaign\ActiveCampaignConfig;
use FondOfSpryker\Zed\ActiveCampaign\Business\Service\ContactService;
use Generated\Shared\Transfer\ActiveCampaignRequestTransfer;
use Generated\Shared\Transfer\ActiveCampaignResponseTransfer;

/**
 * @method \FondOfSpryker\Zed\ActiveCampaign\Business\ActiveCampaignBusinessFactory getFactory()
 */
class SubscriptionHandler
{
    /**
     * @var \FondOfSpryker\Zed\ActiveCampaign\ActiveCampaignConfig
     */
    protected $config;

    /**
     * @var \FondOfSpryker\Zed\ActiveCampaign\Business\Service\ContactService
     */
    protected $service;

    /**
     * @var \Generated\Shared\Transfer\ActiveCampaignRequestTransfer
     */
    protected $transfer;

    /**
     * SubscriptionHandler constructor.
     *
     * @param \Generated\Shared\Transfer\ActiveCampaignRequestTransfer $config
     * @param \FondOfPHP\ActiveCampaign\Service\Contact $contactService
     * @param \Generated\Shared\Transfer\ActiveCampaignRequestTransfer $activeCampaignRequestTransfer
     */
    public function __construct(
        ActiveCampaignConfig $config,
        ContactService $contactService,
        ActiveCampaignRequestTransfer $activeCampaignRequestTransfer
    ) {
        AnnotationRegistry::registerLoader('class_exists');

        $this->config = $config;
        $this->transfer = $activeCampaignRequestTransfer;
        $this->config->initByTransfer($this->transfer);
        $this->service = $contactService;
    }

    /**
     * @return void
     */
    public function processNewsletterSubscriptions(): void
    {
        /** @var \FondOfPHP\ActiveCampaign\DataTransferObject\Contact $contact */
        $contact = $this->service->getByEmail($this->transfer->getEmail());

        $response = new ActiveCampaignResponseTransfer();

        if ($contact !== null && $contact->getId() > 0) {
            if (false === $this->isContactActiveOnListId($contact)) {
                if (true === $this->isContactActiveOnAnyList($contact)) {
                    $response->setAddedToList(true);
                    $this->service->linkContactToList($contact, $this->config->getListId());
                }
            } else {
                $response->setAllreadyInList(true);
            }
        } else {
            $response = $this->createNewContact();
        }

        //return $response;
    }

    /**
     * @return \Generated\Shared\Transfer\ActiveCampaignResponseTransfer
     */
    protected function createNewContact()
    {
        $result = $this->service->formRequest(['email' => $this->transfer->getEmail()], $this->config->getFormId());
        $activeCampaignResponseTransfer = new ActiveCampaignResponseTransfer();

        if ($result === true) {
            $activeCampaignResponseTransfer->setSubscribe(true);
        }

        return $activeCampaignResponseTransfer;
    }

    /**
     * @param \FondOfPHP\ActiveCampaign\DataTransferObject\Contact $contact
     *
     * @return bool
     */
    protected function isContactActiveOnListId(Contact $contact)
    {
        if ($contact->getId() > 0 && $contact->getLists()) {

            /** @var \FondOfPHP\ActiveCampaign\DataTransferObject\ContactMailingListRelation $list */
            foreach ($contact->getLists() as $list) {
                if ($list->getListId() === $this->config->getListId()) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * @param \FondOfPHP\ActiveCampaign\DataTransferObject\Contact $contact
     *
     * @return bool
     */
    protected function isContactActiveOnAnyList(Contact $contact)
    {
        if (count($contact->getLists()) > 0) {

            /** @var \FondOfPHP\ActiveCampaign\DataTransferObject\ContactMailingListRelation $list */
            foreach ($contact->getLists() as $list) {
                if ($list->getStatus() === 1) {
                    return true;
                }
            }
        }

        return false;
    }
}

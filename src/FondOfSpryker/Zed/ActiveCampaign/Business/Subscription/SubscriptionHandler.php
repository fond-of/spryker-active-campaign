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
     * @param \FondOfSpryker\Zed\ActiveCampaign\ActiveCampaignConfig $config
     * @param \FondOfSpryker\Zed\ActiveCampaign\Business\Service\ContactService $contactService
     */
    public function __construct(ActiveCampaignConfig $config, ContactService $contactService)
    {
        AnnotationRegistry::registerLoader('class_exists');

        $this->config = $config;
        $this->service = $contactService;
    }

    /**
     * @return \Generated\Shared\Transfer\ActiveCampaignResponseTransfer
     */
    protected function createActiveCampaignResponseTransfer(): ActiveCampaignResponseTransfer
    {
        return new ActiveCampaignResponseTransfer();
    }

    /**
     * @param \Generated\Shared\Transfer\ActiveCampaignRequestTransfer $activeCampaignRequestTransfer
     *
     * @return void
     */
    public function processNewsletterSubscriptions(ActiveCampaignRequestTransfer $activeCampaignRequestTransfer): void
    {
        $activeCampaignResponseTransfer = $this->createActiveCampaignResponseTransfer();

        /** @var \FondOfPHP\ActiveCampaign\DataTransferObject\Contact $contact */
        $contact = $this->service->getByEmail($activeCampaignRequestTransfer->getEmail());

        if ($contact !== null && $contact->getId() > 0) {
            if ($this->isContactActiveOnListId($contact, $activeCampaignRequestTransfer) === false) {
                if ($this->isContactActiveOnAnyList($contact) === true) {
                    $activeCampaignResponseTransfer->setAddedToList(true);
                    $this->service->linkContactToList($contact, $this->config->getListId($activeCampaignRequestTransfer->getLocale()));
                }
            } else {
                $activeCampaignResponseTransfer->setAllreadyInList(true);
            }
        } else {
            $this->createNewContact($activeCampaignRequestTransfer, $activeCampaignResponseTransfer);
        }
    }

    /**
     * @param \Generated\Shared\Transfer\ActiveCampaignRequestTransfer $activeCampaignRequestTransfer
     * @param \Generated\Shared\Transfer\ActiveCampaignResponseTransfer $activeCampaignResponseTransfer
     *
     * @return \Generated\Shared\Transfer\ActiveCampaignResponseTransfer
     */
    protected function createNewContact(
        ActiveCampaignRequestTransfer $activeCampaignRequestTransfer,
        ActiveCampaignResponseTransfer $activeCampaignResponseTransfer
    ): ActiveCampaignResponseTransfer {
        $result = $this->service->formRequest(['email' => $activeCampaignRequestTransfer->getEmail()], $this->config->getFormId($activeCampaignRequestTransfer->getLocale()));

        if ($result === true) {
            $activeCampaignResponseTransfer->setSubscribe(true);
        }

        return $activeCampaignResponseTransfer;
    }

    /**
     * @param \FondOfPHP\ActiveCampaign\DataTransferObject\Contact $contact
     * @param \Generated\Shared\Transfer\ActiveCampaignRequestTransfer $activeCampaignRequestTransfer
     *
     * @return bool
     */
    protected function isContactActiveOnListId(Contact $contact, ActiveCampaignRequestTransfer $activeCampaignRequestTransfer): bool
    {
        if ($contact->getId() > 0 && $contact->getLists()) {

            /** @var \FondOfPHP\ActiveCampaign\DataTransferObject\ContactMailingListRelation $list */
            foreach ($contact->getLists() as $list) {
                if ($list->getListId() === $this->config->getListId($activeCampaignRequestTransfer->getLocale())) {
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
    protected function isContactActiveOnAnyList(Contact $contact): bool
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

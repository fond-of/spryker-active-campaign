<?php

namespace FondOfSpryker\Yves\ActiveCampaign\Controller;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Generated\Shared\Transfer\ActiveCampaignRequestTransfer;
use Spryker\Yves\Kernel\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \FondOfSpryker\Yves\ActiveCampaign\ActiveCampaignFactory getFactory()
 * @method \FondOfSpryker\Client\ActiveCampaign\ActiveCampaignClientInterface getClient()
 */
class IndexController extends AbstractController
{
    /**
     * @var \FondOfBags\ActiveCampaign\Service\Contact $test
     */
    protected $test;

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function subscribeAction(Request $request)
    {
        AnnotationRegistry::registerLoader('class_exists');

        $activeCampaignSubscriptionForm = $this
            ->getFactory()
            ->getActiveCampaignSubscriptionForm();

        $parentRequest = $this->getApplication()['request_stack']->getParentRequest();

        if ($parentRequest !== null) {
            $request = $parentRequest;
        }

        $activeCampaignSubscriptionForm->handleRequest($request);

        if ($activeCampaignSubscriptionForm->isValid()) {

            /** @var \Generated\Shared\Transfer\ActiveCampaignRequestTransfer $transfer */
            $transfer = new ActiveCampaignRequestTransfer();
            $transfer
                ->setEmail($activeCampaignSubscriptionForm->get('email')->getData())
                ->setLocale($this->getLocale());

            $response = $this->getClient()->subscribe($transfer);
        }

        return [
            'activeCampaignSubscriptionForm' => $activeCampaignSubscriptionForm->createView(),
        ];
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function subscribeConfirmationAction(Request $request)
    {
        return [];
    }
}

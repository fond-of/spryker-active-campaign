<?php

namespace FondOfSpryker\Yves\ActiveCampaign\Controller;

use Doctrine\Common\Annotations\AnnotationRegistry;
use FondOfSpryker\Yves\ActiveCampaign\Plugin\Provider\ActiveCampaignControllerProvider;
use Generated\Shared\Transfer\ActiveCampaignRequestTransfer;
use Pyz\Yves\Application\Plugin\Provider\ApplicationControllerProvider;
use Spryker\Yves\Kernel\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \FondOfSpryker\Yves\ActiveCampaign\ActiveCampaignFactory getFactory()
 * @method \FondOfSpryker\Client\ActiveCampaign\ActiveCampaignClientInterface getClient()
 */
class IndexController extends AbstractController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function formAction(Request $request)
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
     * we need to request the submit on this function because we cant
     * redirect an form rendering view.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function submitAction(Request $request)
    {
        $activeCampaignSubscriptionForm = $this
            ->getFactory()
            ->getActiveCampaignSubscriptionForm();

        $activeCampaignSubscriptionForm->handleRequest($request);

        if ($activeCampaignSubscriptionForm->isValid()) {
            /** @var \Generated\Shared\Transfer\ActiveCampaignRequestTransfer $transfer */
            $transfer = new ActiveCampaignRequestTransfer();
            $transfer
                ->setEmail($activeCampaignSubscriptionForm->get('email')->getData())
                ->setLocale($this->getLocale());

            $response = $this->getClient()->subscribe($transfer);

            return $this->redirectResponseInternal(ActiveCampaignControllerProvider::ROUTE_ACTIVECAMPAIGN_SUBSCRIBE, [
                'newsletter' => 'newsletter',
            ]);
        } else {
            return $this->redirectResponseInternal(ApplicationControllerProvider::ROUTE_HOME);
        }
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

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function subscribeAction(Request $request)
    {
        return [];
    }
}

<?php

namespace FondOfSpryker\Yves\ActiveCampaign\Controller;

use Doctrine\Common\Annotations\AnnotationRegistry;
use FondOfSpryker\Yves\ActiveCampaign\Plugin\Provider\ActiveCampaignControllerProvider;
use Generated\Shared\Transfer\ActiveCampaignRequestTransfer;
use Spryker\Yves\Kernel\Controller\AbstractController;
use SprykerShop\Yves\HomePage\Plugin\Provider\HomePageControllerProvider;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \FondOfSpryker\Yves\ActiveCampaign\ActiveCampaignFactory getFactory()
 * @method \FondOfSpryker\Client\ActiveCampaign\ActiveCampaignClientInterface getClient()
 */
class IndexController extends AbstractController
{
    /**
     * @param string $email
     *
     * @return \Generated\Shared\Transfer\ActiveCampaignRequestTransfer
     */
    protected function createActiveCampaignRequestTransfer(string $email): ActiveCampaignRequestTransfer
    {
        $activeCampaignRequestTransfer = new ActiveCampaignRequestTransfer();
        $activeCampaignRequestTransfer->setEmail($email);
        $activeCampaignRequestTransfer->setLocale($this->getLocale());

        return $activeCampaignRequestTransfer;
    }
    
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function formAction(Request $request): array
    {
        AnnotationRegistry::registerLoader('class_exists');

        $parentRequest = $this->getApplication()['request_stack']->getParentRequest();
        if ($parentRequest !== null) {
            $request = $parentRequest;
        }

        $activeCampaignSubscriptionForm = $this->getFactory()->getActiveCampaignSubscriptionForm()->handleRequest($request);
        if ($activeCampaignSubscriptionForm->isValid()) {
            $this->getClient()->subscribe(
                $this->createActiveCampaignRequestTransfer($activeCampaignSubscriptionForm->get('email')->getData())
            );
        }

        return [
            'activeCampaignSubscriptionForm' => $activeCampaignSubscriptionForm->createView(),
        ];
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function submitAction(Request $request): RedirectResponse
    {
        $activeCampaignSubscriptionForm = $this->getFactory()->getActiveCampaignSubscriptionForm()->handleRequest($request);
        if (!$activeCampaignSubscriptionForm->isValid()) {
            return $this->redirectResponseInternal(HomePageControllerProvider::ROUTE_HOME);
        }

        $this->getClient()->subscribe(
            $this->createActiveCampaignRequestTransfer($activeCampaignSubscriptionForm->get('email')->getData())
        );

        return $this->redirectResponseInternal(ActiveCampaignControllerProvider::ROUTE_ACTIVECAMPAIGN_SUBSCRIBE, [
            'newsletter' => 'newsletter',
        ]);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function subscribeConfirmationAction(Request $request): array
    {
        return [];
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function subscribeAction(Request $request): array
    {
        return [];
    }
}

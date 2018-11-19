<?php

namespace FondOfSpryker\Yves\ActiveCampaign\Plugin\Provider;

use Silex\Application;
use Spryker\Yves\Kernel\BundleConfigResolverAwareTrait;
use SprykerShop\Yves\ShopApplication\Plugin\Provider\AbstractYvesControllerProvider;

/**
 * @method \FondOfSpryker\Yves\ActiveCampaign\ActiveCampaignConfig getConfig()
 */
class ActiveCampaignControllerProvider extends AbstractYvesControllerProvider
{
    use BundleConfigResolverAwareTrait;

    public const ROUTE_ACTIVECAMPAIGN_FOOTER = 'ROUTE_ACTIVECAMPAIGN_FOOTER';
    public const ROUTE_ACTIVECAMPAIGN_SUBMIT = 'ROUTE_ACTIVECAMPAIGN_SUBMIT';
    public const ROUTE_ACTIVECAMPAIGN_SUBSCRIBE = 'ROUTE_ACTIVECAMPAIGN_SUBSCRIBE';
    public const ROUTE_ACTIVECAMPAIGN_SUBSCRIBE_CONFIRM = 'ROUTE_ACTIVECAMPAIGN_SUBSCRIBE_CONFIRM';

    /**
     * @param \Silex\Application $app
     *
     * @return void
     */
    protected function defineControllers(Application $app): void
    {
        $locale = $app->offsetGet('locale');

        $this->addFormRoute()
            ->addFormSubmitRoute()
            ->addSubscribeRoute($locale)
            ->addConfirmationRoute($locale);
    }

    /**
     * @return $this
     */
    protected function addFormSubmitRoute(): self
    {
        $this->createController('/{newsletter}/submit', static::ROUTE_ACTIVECAMPAIGN_SUBMIT, 'ActiveCampaign', 'Index', 'submit')
            ->assert('newsletter', $this->getAllowedLocalesPattern() . 'newsletter|newsletter')
            ->value('newsletter', 'newsletter')
            ->method('GET|POST');

        return $this;
    }

    /**
     * @return $this
     */
    protected function addFormRoute(): self
    {
        $this->createController('/{newsletter}/form', static::ROUTE_ACTIVECAMPAIGN_FOOTER, 'ActiveCampaign', 'Index', 'form')
            ->assert('newsletter', $this->getAllowedLocalesPattern() . 'newsletter|newsletter')
            ->value('newsletter', 'newsletter')
            ->method('GET|POST');

        return $this;
    }

    /**
     * @param string $locale
     *
     * @return $this
     */
    protected function addSubscribeRoute(string $locale): self
    {
        $subscribePathPart = $this->getConfig()->getSubscribePathPart($locale);

        $this->createController(sprintf('/{newsletter}/%s', $subscribePathPart), static::ROUTE_ACTIVECAMPAIGN_SUBSCRIBE, 'ActiveCampaign', 'Index', 'subscribe')
            ->assert('newsletter', $this->getAllowedLocalesPattern() . 'newsletter|newsletter')
            ->value('newsletter', 'newsletter')
            ->method('GET');

        return $this;
    }

    /**
     * @param string $locale
     *
     * @return $this
     */
    protected function addConfirmationRoute(string $locale): self
    {
        $confirmationPathPart = $this->getConfig()->getConfirmationPathPart($locale);

        $this->createController(sprintf('/{newsletter}/%s', $confirmationPathPart), static::ROUTE_ACTIVECAMPAIGN_SUBSCRIBE, 'ActiveCampaign', 'Index', 'subscribeConfirmation')
            ->assert('newsletter', $this->getAllowedLocalesPattern() . 'newsletter|newsletter')
            ->value('newsletter', 'newsletter')
            ->method('GET');

        return $this;
    }
}

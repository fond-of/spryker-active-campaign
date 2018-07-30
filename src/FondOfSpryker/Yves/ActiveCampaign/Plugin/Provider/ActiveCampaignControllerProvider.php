<?php
namespace FondOfSpryker\Yves\ActiveCampaign\Plugin\Provider;

use Silex\Application;
use SprykerShop\Yves\ShopApplication\Plugin\Provider\AbstractYvesControllerProvider;

class ActiveCampaignControllerProvider extends AbstractYvesControllerProvider
{
    const ROUTE_ACTIVECAMPAIGN_FOOTER = 'ROUTE_ACTIVECAMPAIGN_FOOTER';
    const ROUTE_ACTIVECAMPAIGN_SUBMIT = 'ROUTE_ACTIVECAMPAIGN_SUBMIT';
    const ROUTE_ACTIVECAMPAIGN_SUBSCRIBE = 'ROUTE_ACTIVECAMPAIGN_SUBSCRIBE';
    const ROUTE_ACTIVECAMPAIGN_SUBSCRIBE_CONFIRM = 'ROUTE_ACTIVECAMPAIGN_SUBSCRIBE_CONFIRM';

    const URL_NEWSLETTER_CONFIRMED_DE = 'anmeldebestaetigung';
    const URL_NEWSLETTER_CONFIRMED_EN = 'subscribe-confirmation';
    const URL_NEWSLETTER_SUBSCRIBE_DE = 'anmeldung';
    const URL_NEWSLETTER_SUBSCRIBE_EN = 'subscribe';

    /**
     * @param \Silex\Application $app
     *
     * @return void
     */
    protected function defineControllers(Application $app)
    {
        $allowedLocalesPattern = $this->getAllowedLocalesPattern();

        $subscribe = ($app->offsetGet('locale') === 'de_DE')
            ? self::URL_NEWSLETTER_SUBSCRIBE_DE
            : self::URL_NEWSLETTER_SUBSCRIBE_EN;

        $confirmation = ($app->offsetGet('locale') === 'de_DE')
            ? self::URL_NEWSLETTER_CONFIRMED_DE
            : self::URL_NEWSLETTER_CONFIRMED_EN;

        $this->createController(
            '{newsletter}/submit',
            static::ROUTE_ACTIVECAMPAIGN_SUBMIT,
            'ActiveCampaign',
            'Index',
            'submit'
        )
            ->method('GET|POST')
            ->assert('newsletter', $allowedLocalesPattern . 'newsletter|newsletter');
        ;

        $this->createController(
            '{locale}/newsletter/form',
            static::ROUTE_ACTIVECAMPAIGN_FOOTER,
            'ActiveCampaign',
            'Index',
            'form'
        )->method('GET|POST');

        $this->createController(
            '{newsletter}/' . $subscribe,
            static::ROUTE_ACTIVECAMPAIGN_SUBSCRIBE,
            'ActiveCampaign',
            'Index',
            'subscribe'
        )
            ->method('GET')
            ->assert('newsletter', $allowedLocalesPattern . 'newsletter|newsletter');
        ;

        $this->createController(
            '{newsletter}/' . $confirmation,
            static::ROUTE_ACTIVECAMPAIGN_SUBSCRIBE_CONFIRM,
            'ActiveCampaign',
            'Index',
            'subscribeConfirmation'
        )
            ->method('GET')
            ->assert('newsletter', $allowedLocalesPattern . 'newsletter|newsletter');
        ;
    }
}

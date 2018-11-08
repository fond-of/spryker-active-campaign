<?php
namespace FondOfSpryker\Yves\ActiveCampaign\Plugin\Provider;

use FondOfSpryker\Shared\ActiveCampaign\ActiveCampaignConstants;
use Silex\Application;
use Spryker\Shared\Config\Config;
use SprykerShop\Yves\ShopApplication\Plugin\Provider\AbstractYvesControllerProvider;

class ActiveCampaignControllerProvider extends AbstractYvesControllerProvider
{
    const ROUTE_ACTIVECAMPAIGN_FOOTER = 'ROUTE_ACTIVECAMPAIGN_FOOTER';
    const ROUTE_ACTIVECAMPAIGN_SUBMIT = 'ROUTE_ACTIVECAMPAIGN_SUBMIT';
    const ROUTE_ACTIVECAMPAIGN_SUBSCRIBE = 'ROUTE_ACTIVECAMPAIGN_SUBSCRIBE';
    const ROUTE_ACTIVECAMPAIGN_SUBSCRIBE_CONFIRM = 'ROUTE_ACTIVECAMPAIGN_SUBSCRIBE_CONFIRM';

    /**
     * @param \Silex\Application $app
     *
     * @return void
     */
    protected function defineControllers(Application $app)
    {
        $allowedLocalesPattern = $this->getAllowedLocalesPattern();

        $confirmation = Config::get(
            ActiveCampaignConstants::URL_NEWSLETTER_CONFIRMED . $app->offsetGet('locale'),
            ActiveCampaignConstants::URL_NEWSLETTER_CONFIRMED
        );

        $subscribe = Config::get(
            ActiveCampaignConstants::URL_NEWSLETTER_SUBSCRIBE . $app->offsetGet('locale'),
            ActiveCampaignConstants::URL_NEWSLETTER_SUBSCRIBE
        );

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

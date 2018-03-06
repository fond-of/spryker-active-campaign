<?php
namespace FondOfSpryker\Yves\ActiveCampaign\Plugin\Provider;

use Pyz\Yves\Application\Plugin\Provider\AbstractYvesControllerProvider;
use Silex\Application;

class ActiveCampaignControllerProvider extends AbstractYvesControllerProvider
{
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

        $this->createController(
            '{newsletter}/subscribe/',
            static::ROUTE_ACTIVECAMPAIGN_SUBSCRIBE,
            'ActiveCampaign',
            'Index',
            'subscribe'
        )
            ->method('GET|POST')
            ->assert('newsletter', $allowedLocalesPattern . 'newsletter|newsletter');
        ;

        $this->createController(
            '/newsletter/subscribe-confirmation/',
            static::ROUTE_ACTIVECAMPAIGN_SUBSCRIBE_CONFIRM,
            'ActiveCampaign',
            'Index',
            'subscribeConfirmation'
        )
            ->method('GET|POST')
            ->assert('newsletter', $allowedLocalesPattern . 'newsletter|newsletter');
        ;
    }
}

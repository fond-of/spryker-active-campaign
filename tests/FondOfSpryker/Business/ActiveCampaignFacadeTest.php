<?php

namespace FondOfSpryker\Zed\ActiveCampaign\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ActiveCampaign\Business\Subscription\SubscriptionHandler;
use Generated\Shared\Transfer\ActiveCampaignRequestTransfer;

class ActiveCampaignFacadeTest extends Unit
{
    /**
     * @return void
     */
    public function testSubscribeNew(): void
    {
        $transfer = new ActiveCampaignRequestTransfer();
        $transfer->setEmail('pascal.fischer@fondof.de');

        $factoryMock = $this->getMockBuilder(ActiveCampaignBusinessFactory::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            //->setMethods(['createSubscriptionHandler', 'createConfig', 'createContactService'])
            ->getMock();

        $subscriptionHandlerMock = $this->getMockBuilder(SubscriptionHandler::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->setMethods(['processNewsletterSubscriptions', 'isContactActiveOnListId'])
            ->getMock();

        $factoryMock->expects($this->once())
            ->method('createSubscriptionHandler')
            ->willReturn($subscriptionHandlerMock);

        $subscriptionHandlerMock->expects($this->once())
            ->method('processNewsletterSubscriptions');

        $subscriptionHandlerMock->expects($this->exactly(0))
            ->method('isContactActiveOnListId');

        $factoryMock->createSubscriptionHandler($transfer)->processNewsletterSubscriptions();
    }
}

<?php

namespace FondOfSpryker\Zed\ActiveCampaign;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ActiveCampaignRequestTransfer;

class ActiveCampaignConfigTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ActiveCampaign\ActiveCampaignConfig
     */
    protected $activeCampaignConfig;

    /**
     * @var \Generated\Shared\Transfer\ActiveCampaignRequestTransfer
     */
    private $activeCampaignTransfer;

    /**
     * @return void
     */
    protected function _before()
    {
        $this->activeCampaignConfig = new ActiveCampaignConfig();
        $this->activeCampaignTransfer = new ActiveCampaignRequestTransfer();
        $this->activeCampaignTransfer->setLocale('de_DE');
    }

    /**
     * @return void
     */
    public function testGetApiKey(): void
    {
        $this->assertEquals('TESTAPIKEY', $this->activeCampaignConfig->getApiKey());
    }

    /**
     * @return void
     */
    public function testGetUrl(): void
    {
        $this->assertEquals('API_URL', $this->activeCampaignConfig->getUrl());
    }

    /**
     * @return void
     */
    public function testGetFormIdDefault(): void
    {
        $this->assertEquals(1111, $this->activeCampaignConfig->getFormId($this->activeCampaignTransfer->getLocale()));
    }

    /**
     * @return void
     */
    public function testGetFormIdEn(): void
    {
        $this->activeCampaignTransfer->setLocale('en_US');
        $this->assertEquals(2222, $this->activeCampaignConfig->getFormId($this->activeCampaignTransfer->getLocale()));
    }

    /**
     * @return void
     */
    public function testGetListIdDefault(): void
    {
        $this->assertEquals(11, $this->activeCampaignConfig->getListId($this->activeCampaignTransfer->getLocale()));
    }

    /**
     * @return void
     */
    public function testGetListIdEn(): void
    {
        $this->activeCampaignTransfer->setLocale('en_US');
        $this->assertEquals('subscribe_url', $this->activeCampaignConfig->getSubscribePathPart($this->activeCampaignTransfer->getLocale()));
    }

    /**
     * @return void
     */
    public function testGetSubscribeUrl(): void
    {
        $this->assertEquals('subscribe_confirm_url', $this->activeCampaignConfig->getConfirmationPathPart($this->activeCampaignTransfer->getLocale()));
    }
}

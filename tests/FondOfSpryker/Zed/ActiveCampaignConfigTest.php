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
     * @var \org\bovigo\vfs\vfsStreamDirectory
     */
    protected $vfsStreamDirectory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    private $activeCampaignTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ActiveCampaignRequestTransfer
     */
    private $activeCampaignTransfer;

    /**
     * @return void
     */
    protected function _before()
    {
        /*$this->activeCampaignTransferMock = $this
            ->getMockBuilder('\Generated\Shared\Transfer\ActiveCampaignTransfer')
            ->disableOriginalConstructor()
            ->setMethods(['getLocale', 'setLocale'])
            ->getMock();*/

        $this->activeCampaignTransfer = new ActiveCampaignRequestTransfer();
        $this->activeCampaignTransfer->setLocale(ActiveCampaignConfig::DEFAULT_LOCALE);

        $this->activeCampaignConfig = new ActiveCampaignConfig();
        $this->activeCampaignConfig->initByTransfer($this->activeCampaignTransfer);
    }

    /**
     * @return void
     */
    public function testGetApiKey()
    {
        $this->assertEquals('TESTAPIKEY', $this->activeCampaignConfig->getApiKey());
    }

    /**
     * @return void
     */
    public function testGetUrl()
    {
        $this->assertEquals('API_URL', $this->activeCampaignConfig->getUrl());
    }

    /**
     * @return void
     */
    public function testGetFormIdDefault()
    {
        $this->assertEquals(1111, $this->activeCampaignConfig->getFormId());
    }

    /**
     * @return void
     */
    public function testGetFormIdEn()
    {
        $this->activeCampaignTransfer->setLocale('en_US');
        $this->activeCampaignConfig->initByTransfer($this->activeCampaignTransfer);
        $this->assertEquals(2222, $this->activeCampaignConfig->getFormId());
    }

    /**
     * @return void
     */
    public function testGetListIdDefault()
    {
        $this->assertEquals(11, $this->activeCampaignConfig->getListId());
    }

    /**
     * @return void
     */
    public function testGetListIdEn()
    {
        $this->activeCampaignTransfer->setLocale('en_US');
        $this->activeCampaignConfig->initByTransfer($this->activeCampaignTransfer);
        $this->assertEquals('subscribe_url', $this->activeCampaignConfig->getSubscribeUrl());
    }

    /**
     * @return void
     */
    public function testGetSubscribeUrl()
    {
        $this->assertEquals('subscribe_confirm_url', $this->activeCampaignConfig->getSubscribeConfirmUrl());
    }
}

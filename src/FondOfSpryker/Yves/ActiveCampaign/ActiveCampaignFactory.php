<?php
namespace FondOfSpryker\Yves\ActiveCampaign;

use FondOfSpryker\Yves\ActiveCampaign\Form\ActiveCampaginSubscriptionForm;
use Spryker\Shared\Application\ApplicationConstants;
use Spryker\Yves\Kernel\AbstractFactory;
use Symfony\Component\Form\FormInterface;

class ActiveCampaignFactory extends AbstractFactory
{
    /**
     * @return \Symfony\Component\Form\FormInterface
     */
    public function getActiveCampaignSubscriptionForm(): FormInterface
    {
        return $this->getProvidedDependency(ApplicationConstants::FORM_FACTORY)
            ->create($this->createActiveCampaginSubscriptionForm());
    }

    /**
     * @return string
     */
    protected function createActiveCampaginSubscriptionForm(): string
    {
        return ActiveCampaginSubscriptionForm::class;
    }
}

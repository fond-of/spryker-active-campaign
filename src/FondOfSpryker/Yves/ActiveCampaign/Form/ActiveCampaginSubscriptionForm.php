<?php

namespace FondOfSpryker\Yves\ActiveCampaign\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ActiveCampaginSubscriptionForm extends AbstractType
{
    const FORM_ID = 'active_campagin';
    const FIELD_EMAIL = 'email';
    const FIELD_SUBMIT = 'submit';

    /**
     * @return string
     */
    public function getBlockPrefix(): string
    {
        return 'activeCampaignSubscriptionForm';
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(self::FIELD_EMAIL, EmailType::class, [
                'label' => false,
                'required' => false,
                'constraints' => [
                    new NotBlank(),
                ],
                'attr' => [
                    'class' => 'input-group-field',
                    'placeholder' => 'newsletter.subscribe',
                ],
            ])
            ->add(self::FIELD_SUBMIT, SubmitType::class, [
                'attr' => [
                    'class' => 'button expanded',
                ],
            ]);
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'attr' => [
                'id' => self::FORM_ID,
            ],
            'csrf_protection' => false,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Account;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('accountName')
            ->add('accountType')
            ->add('industry')
            ->add('annualRevenue')
            ->add('phone')
            ->add('otherPhone')
            ->add('email1')
            ->add('email2')
            ->add('website')
            ->add('fax')
            ->add('billingStreet')
            ->add('billingCity')
            ->add('billingZipcode')
            ->add('billingCountry', CountryType::class, [
                'preferred_choices' => ['FR']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Account::class,
        ]);
    }
}

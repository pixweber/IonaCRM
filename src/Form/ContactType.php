<?php

namespace App\Form;

use App\Entity\Account;
use App\Entity\Contact;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('owner', EntityType::class, array(
                'class' => User::class,
                'choice_label' => 'firstName'
            ))
            ->add('firstName')
            ->add('lastName')
            ->add('salutation')
            ->add('email')
            ->add('phone')
            ->add('mobile')
            ->add('account', EntityType::class, array(
                'class' => Account::class,
                'choice_label' => 'accountName'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}

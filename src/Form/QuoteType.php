<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\Quote;
use App\Entity\User;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('client', EntityType::class, array(
                'class' => Contact::class,
                'label' => 'Contact',
            ))
            ->add('owner', EntityType::class, array(
                'class' => User::class,
                'label' => 'Assigned to'
            ))
            ->add('validUntil', DateType::class, array(
                'widget' => 'choice'
            ))
            ->add('subject')
            ->add('status')
            ->add('description')
            ->add('subtotal', HiddenType::class, array(
                'data' => 0
            ))
            ->add('adjustment', HiddenType::class, array(
                'data' => 0
            ))
            ->add('total', HiddenType::class, array(
                'data' => 0
            ))
            ->add('quoteLineItems', CollectionType::class, array(
                'entry_type' => QuoteLineItemType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Quote::class,
        ]);
    }
}

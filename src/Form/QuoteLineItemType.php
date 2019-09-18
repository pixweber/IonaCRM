<?php

namespace App\Form;

use App\Entity\QuoteLineItem;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuoteLineItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('product')
            ->add('price')
            ->add('quantity')
            ->add('discountPercent')
            ->add('discountAmount')
            ->add('description')
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => QuoteLineItem::class,
        ]);
    }
}

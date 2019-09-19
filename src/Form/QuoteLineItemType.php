<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\QuoteLineItem;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuoteLineItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('product', EntityType::class, array(
                'class' => Product::class,
                'choice_label' => 'productName',
                'required' => true,
                'placeholder' => 'Select a product',
                'choice_attr' => array(
                    'data-price' => 'price'
                )
            ))
            ->add('price')
            ->add('quantity', IntegerType::class, array(
                'attr' => array(
                    'min' => 1,
                ),
                'empty_data' => 1
            ))
            ->add('discountPercent', NumberType::class, array(
                'attr' => array(
                    'min' => 0,
                    'max' => 100
                )
            ))
            ->add('discountAmount')
            ->add('description', TextareaType::class, array(
                'attr' => array(
                    'rows' => 2,
                    'placeholder' => 'Description here'
                )
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => QuoteLineItem::class,
        ]);
    }
}

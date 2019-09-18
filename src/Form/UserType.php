<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType {

    protected $roles;

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
            ->add('username')
            ->add('email')
            ->add('enabled')
            ->add('password', PasswordType::class)
            ->add(
                'roles', ChoiceType::class, [
                    'choices' => array(
                        'ROLE_ADMIN' => 'ROLE_ADMIN',
                        'ROLE_USER' => 'ROLE_USER'
                    ),
                    'expanded' => true,
                    'multiple' => true,
                    'label' => 'Roles'
                ]
            )
            ->add('phone')
            ->add('mobile')
            ->add('firstName')
            ->add('lastName')
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }

    /**
     * @param $roles
     * @return array
     */
    private function arrangeRoles($roles) {
        $roles = [];

        $rolesParent = array_keys($roles);
        foreach ($rolesParent as $roleParent) {
            if ('ROLE_ADMIN' !== $roleParent) {
                $roles[$roleParent] = $roleParent;
            }
        }

        return $roles;
    }
}

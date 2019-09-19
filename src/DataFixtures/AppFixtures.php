<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager) {
        // $product = new Product();
        // $manager->persist($product);

        //$manager->flush();

        $user = new User();
        $user->setUsername('admin');
        $user->setEmail('contact@pixweber.com');
        $user->setEnabled(true);
        $user->setPlainPassword('admin');
        $user->setRoles(array('ROLE_ADMIN'));
        $manager->persist($user);

        $manager->flush();
    }
}

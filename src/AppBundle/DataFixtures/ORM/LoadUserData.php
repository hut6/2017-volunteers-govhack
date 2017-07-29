<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        /** @var User $user */
        $user = new User();
        $user->setUsername('admin@dev.local');
        $user->setUsernameCanonical('admin@dev.local');
        $user->setEmail('admin@dev.local');
        $user->setEmailCanonical('admin@dev.local');
        $user->setPlainPassword('admin@dev.local');
        $user->setRoles([
            User::ROLE_ADMIN
        ]);
        $user->setEnabled(true);
        $manager->persist($user);
        $this->addReference('user-dev', $user);


        $manager->flush();
    }


    public function getOrder()
    {
        return 1;
    }
}
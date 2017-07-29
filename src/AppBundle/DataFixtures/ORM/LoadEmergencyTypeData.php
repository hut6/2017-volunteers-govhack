<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\EmergencyType;
use AppBundle\Entity\Skill;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadEmergencyTypeData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $types = [
            'House Fire',
            'Bush Fire',
            'Burn Off',
            'Car Crash',
            'Medical Emergency',
            'Search & Rescue',
            'Amber Alert',
        ];

        foreach ($types as $name) {
            /** @var EmergencyType $skill */
            $type = new EmergencyType();
            $type->setName($name);
            $manager->persist($type);
        }

        $manager->flush();
    }


    public function getOrder()
    {
        return 1;
    }
}
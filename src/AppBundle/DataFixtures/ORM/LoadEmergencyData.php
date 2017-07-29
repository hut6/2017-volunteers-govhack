<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Emergency;
use AppBundle\Entity\EmergencyType;
use AppBundle\Entity\Skill;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadEmergencyData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $emergencies = [
            'Fire and Rescue crews were called out to a house fire on Cromwell Drive',
        ];

        foreach ($emergencies as $description) {
            /** @var Emergency $emergency */
            $emergency = new Emergency();
            $emergency->setDescription($description);
            $emergency->setEmergencyType(
                $manager->find(EmergencyType::class, 1)
            );
            $manager->persist($emergency);
        }

        $manager->flush();
    }


    public function getOrder()
    {
        return 2;
    }
}
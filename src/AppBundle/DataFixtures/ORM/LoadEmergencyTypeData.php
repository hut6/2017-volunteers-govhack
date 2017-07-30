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
            'Air Crash',
            'Bushfires',
            'Chemical, Biological, Radiological',
            'Coastal marine search and rescue',
            'Confined space',
            'Cyclone',
            'Dam safety',
            'Earthquake',
            'Emergency animal disease',
            'Emergency aquatic animal disease',
            'Emergency plant pest or disease',
            'Emergency marine pest',
            'Fire (within Gazzetted area) ',
            'Flooding',
            'Hazardous material',
            'Human disease',
            'Invasive animal biosecurity',
            'Invasive plant biosecurity',
            'Land search and rescue',
            'Major power outage',
            'Marine oil spill (outside port)',
            'Marine oil spill (Darwin port)',
            'Rail crash',
            'Road crash rescue',
            'Storm surge',
            'storm and water damage',
            'Structural collapse',
            'Terrorism',
            'Tsunami',
            'Urban search and rescue',
            'Vertical rescue',
            'Water contamination (potable)'
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
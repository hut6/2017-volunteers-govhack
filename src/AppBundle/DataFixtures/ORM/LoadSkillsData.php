<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Skill;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadSkillsData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $skills = [
            [ 'name' => 'Firefighters', 'type' => '1. Paid Staff' ],
            [ 'name' => 'First Aid', 'type' => '1. Paid Staff' ],
            [ 'name' => 'Ambos', 'type' => '1. Paid Staff' ],
            [ 'name' => 'Role 1', 'type' => '1. Paid Staff' ],
            [ 'name' => 'Role 2', 'type' => '1. Paid Staff' ],
            [ 'name' => 'Volunteer Firefighters (eg Emily Hill)', 'type' => '2. Volunteers' ],
            [ 'name' => 'Spotters', 'type' => '2. Volunteers' ],
            [ 'name' => 'Sacred Tree Preservation', 'type' => '2. Volunteers' ],
            [ 'name' => 'Media', 'type' => '3. Other' ]
        ];

        foreach ($skills as $name) {

            /** @var Skill $skill */
            $skill = new Skill();

            $skill->setName($name['name']);
            $skill->setType($name['type']);

            $manager->persist($skill);
        }

        $manager->flush();
    }


    public function getOrder()
    {
        return 1;
    }
}
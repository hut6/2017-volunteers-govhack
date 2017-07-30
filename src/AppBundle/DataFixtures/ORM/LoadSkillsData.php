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
            'First Aid',
            'Security',
            'Heavy Machinery',
            'Bush Fire Training',
            'Leadership',
            'Machinery',
            'Rescue',
            'Pilot',
        ];

        //grass fires
        //storm damage
        //general rescue
        //vertical rescue
        //flood rescue
        //air search
        //land search
        //car crash
        //structuee fire
        //car fire
        //non structure fire

        foreach ($skills as $name) {
            /** @var Skill $skill */
            $skill = new Skill();
            $skill->setName($name);
            $manager->persist($skill);
        }

        $manager->flush();
    }


    public function getOrder()
    {
        return 1;
    }
}
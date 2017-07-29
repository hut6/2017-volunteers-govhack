<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Skill;
use AppBundle\Entity\Volunteer;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadVolunteerData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $volunteers = [
            'regan@hutsix.com.au' => 'Regan',
            'johan@hutsix.com.au' => 'Johan',
            'luke@hutsix.com.au' => 'Luke',
            'wolfgang@hutsix.com.au' => 'Wolfgang',
        ];

        foreach($volunteers as $email => $name) {
            /** @var Volunteer $volunteer */
            $volunteer = new Volunteer();
            $volunteer->setName($name);
            $volunteer->setEmail($email);
            $volunteer->setSkills([
                $manager->find(Skill::class, mt_rand(1,4)),
                $manager->find(Skill::class, mt_rand(5,8)),
            ]);
            $manager->persist($volunteer);
        }

        $manager->flush();
    }


    public function getOrder()
    {
        return 1;
    }
}
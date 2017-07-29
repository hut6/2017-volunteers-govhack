<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Report;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadReportData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {

        for($x = 0 ; $x < 15 ; $x++) {

            /** @var Report $report */
            $report = new Report();

            $report->setCreated(new \DateTime());
            $report->setLat(-23.69 * rand(9970, 10070) / 10000);
            $report->setLng(133.88 * rand(9985, 10015) / 10000);

            $manager->persist($report);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
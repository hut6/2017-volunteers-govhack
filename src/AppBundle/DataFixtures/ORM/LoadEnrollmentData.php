<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Emergency;
use AppBundle\Entity\Notification;
use AppBundle\Entity\Volunteer;
use AppBundle\Entity\VolunteerEnrolment;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadEnrollmentData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $volunteers = $manager->getRepository(Volunteer::class)->findAll();
        $emergency = $manager->find(Emergency::class, 1);

        foreach ($volunteers as $volunteer) {
            /** @var VolunteerEnrolment $enrollment */
            $enrollment = new VolunteerEnrolment($emergency, $volunteer);
            $manager->persist($enrollment);

            /** @var Notification $notification */
            $notification = new Notification();
            $notification->setVolunteer($volunteer);
            $notification->setEnrolment($enrollment);
            $notification->setNotificationType(Notification::TYPE_ENROLMENT_NEW);
            $manager->persist($notification);
        }

        $manager->flush();
    }


    public function getOrder()
    {
        return 2;
    }
}
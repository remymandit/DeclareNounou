<?php

namespace DeclareNounou\GestNounouBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DeclareNounou\GestNounouBundle\Entity\Pointage;

class LoadPointageData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {inheritDoc}.
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        //create test pointages
        $pointage1 = new Pointage();
        $pointage1->setContrat($this->getReference('contrat1'));
        $pointage1->setDatePointage(new \DateTime('2014-01-01'));
        $pointage1->setHeureDebut(new \DateTime('10:00'));
        $pointage1->setHeureFin(new \DateTime('14:00'));
        $pointage1->setHeuresComplementaires(1);
        $pointage1->setHeuresNormales(3);
        $pointage1->setHeuresRealiseesPointage(4);
        $pointage1->setRepas(1);

        $pointage2 = new Pointage();
        $pointage2->setContrat($this->getReference('contrat1'));
        $pointage2->setDatePointage(new \DateTime('2014-01-02'));
        $pointage2->setHeureDebut(new \DateTime('9:00:00'));
        $pointage2->setHeureFin(new \DateTime('10:00:00'));
        $pointage2->setHeuresComplementaires(0);
        $pointage2->setHeuresNormales(1);
        $pointage2->setHeuresRealiseesPointage(1);
        $pointage2->setRepas(0);

        $pointage3 = new Pointage();
        $pointage3->setContrat($this->getReference('contrat2'));
        $pointage3->setDatePointage(new \DateTime('2014-01-01'));
        $pointage3->setHeureDebut(new \DateTime('12:00:00'));
        $pointage3->setHeureFin(new \DateTime('13:30:00'));
        $pointage3->setHeuresComplementaires(0);
        $pointage3->setHeuresNormales(1.5);
        $pointage3->setHeuresRealiseesPointage(1.5);
        $pointage3->setRepas(1);

        $manager->persist($pointage1);
        $manager->persist($pointage2);
        $manager->persist($pointage3);
        $manager->flush();
    }

    /**
     * {inheritDoc}.
     */
    public function getOrder()
    {
        return 5;
    }
}

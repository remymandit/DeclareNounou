<?php

namespace DeclareNounou\GestNounouBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DeclareNounou\GestNounouBundle\Entity\Contrat;

class LoadContratData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        //create test contrat
        $contrat1 = new Contrat();
        $contrat1->setDateDebut(new \DateTime('2014-01-01'));
        $contrat1->setDateFin(new \DateTime('2014-12-31'));
        $contrat1->setEnfant($this->getReference('enfant1'));
        $contrat1->setNounou($this->getReference('nounou1'));
        $contrat1->setHeuresMensuelles(120);
        $contrat1->setTarifHoraire(2.50);
        $contrat1->setTarifIndemnite(0.33);
        $contrat1->setTarifRepas(3.50);

        $contrat2 = new Contrat();
        $contrat2->setDateDebut(new \DateTime('2014-01-01'));
        $contrat2->setDateFin(new \DateTime('2014-12-31'));
        $contrat2->setEnfant($this->getReference('enfant2'));
        $contrat2->setNounou($this->getReference('nounou1'));
        $contrat2->setHeuresMensuelles(70);
        $contrat2->setTarifHoraire(2.50);
        $contrat2->setTarifIndemnite(0.33);
        $contrat2->setTarifRepas(3.50);

        $contrat3 = new Contrat();
        $contrat3->setDateDebut(new \DateTime('2014-01-01'));
        $contrat3->setDateFin(new \DateTime('2014-12-31'));
        $contrat3->setEnfant($this->getReference('enfant3'));
        $contrat3->setNounou($this->getReference('nounou2'));
        $contrat3->setHeuresMensuelles(100);
        $contrat3->setTarifHoraire(2.30);
        $contrat3->setTarifIndemnite(0.33);
        $contrat3->setTarifRepas(3.00);

        $manager->persist($contrat1);
        $manager->persist($contrat2);
        $manager->persist($contrat3);
        $manager->flush();

        $this->addReference('contrat1', $contrat1);
        $this->addReference('contrat2', $contrat2);
        $this->addReference('contrat3', $contrat3);
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 4;
    }
}

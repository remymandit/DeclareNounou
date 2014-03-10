<?php
namespace DeclareNounou\GestNounouBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DeclareNounou\GestNounouBundle\Entity\Contrat;

class LoadContratData Extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        //create test contrat
        $contrat = new Contrat();
        $contrat->setDateDebut(new \DateTime('2014-01-01'));
        $contrat->setDateFin(new \DateTime('2014-12-31'));
        $contrat->setEnfant($this->getReference('enfant1'));
        $contrat->setNounou($this->getReference('nounou1'));
        $contrat->setHeuresMensuelles(120);
        $contrat->setTarifHoraire(2.50);
        $contrat->setTarifIndemnite(0.33);
        $contrat->setTarifRepas(3.50);
        
        $manager->persist($contrat);
        $manager->flush();
    }
    
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 4;
    }
}
?>
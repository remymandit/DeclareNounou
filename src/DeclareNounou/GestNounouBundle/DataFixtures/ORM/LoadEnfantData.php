<?php
namespace DeclareNounou\GestNounouBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DeclareNounou\GestNounouBundle\Entity\Enfant;

class LoadEnfantData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        //create a test Enfant
        $enfant = new Enfant();
        $enfant->setNom('Daudet');
        $enfant->setPrenom('Alphonse');
        $enfant->setDateNaissance(new \DateTime('2012-01-01'));
        $manager->persist($enfant);
        $manager->flush();
    }
}
?>

<?php
namespace DeclareNounou\GestNounouBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DeclareNounou\GestNounouBundle\Entity\Nounou;

class LoadNounouData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        //create a test Nounou
        $nounou = new Nounou();
        $nounou->setNom('Duras');
        $nounou->setPrenom('Marguerite');
        $nounou->setAdresse('5 rue ici');
        $nounou->setCodePostal('75000');
        $nounou->setVille('Paris');
        $nounou->setDateNaissance(new \dateTime('1975-01-01'));
        $manager->persist($nounou);
        $manager->flush();
    }
}
?>
